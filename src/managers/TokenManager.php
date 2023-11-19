<?php
    
    namespace src\managers;
    
    use PDO;
    
    class TokenManager
    {
        private PDO $db;
        
        public function __construct(PDO $db)
        {
            $this->db = $db;
        }
        
        public function generateToken($userId)
        {
            $token = bin2hex(random_bytes(16));
            $expiryDate = date('Y-m-d H:i:s', strtotime('+7 days'));
            
            $sql = 'INSERT INTO TOKENS (TOKEN, USER_ID, FECHA_EXP) VALUES (:token, :user_id, :expiry_date)';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->bindParam(':user_id', $userId);
            $stmt->bindParam(':expiry_date', $expiryDate);
            $stmt->execute();
            
            return $token;
        }
        
        public function validateToken($token)
        {
            $sql = 'SELECT * FROM TOKENS WHERE TOKEN = :token AND FECHA_EXP > NOW()';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
        public function deleteToken($token)
        {
            $sql = 'DELETE FROM TOKENS WHERE TOKEN = :token';
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
        }
        
        public function cleanUpExpiredTokens()
        {
            $this->db->exec('DELETE FROM TOKENS WHERE FECHA_EXP < NOW()');
        }
    }