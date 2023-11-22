<?php
    
    use src\utils\Online;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $userManager = new UserManager($db);
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $usersOnline = Online::who();
    $usersOnline = $usersOnline == 1 ? $usersOnline . ' usuario online' : $usersOnline . ' usuarios online';
    $countUsersRegistered = $userManager->userCount();
    $countUsersRegistered = $countUsersRegistered == 1 ? $countUsersRegistered . ' usuario registrado' : $countUsersRegistered . ' usuarios registrados';
    $countThreads = '0';
    $countPosts = '0';
    
    echo <<<HTML
   <footer class="footer">
        <div class="forum-stats desktop-only">
            <ul>
                <li><i class="fi-cnsuxl-user-circle"></i> {$usersOnline}</li>
                <li><i class="fi-xnsuxl-user-solid"></i> {$countUsersRegistered}</li>
                <li><i class="fi-xnsuxl-comment-dots-solid"></i> {$countThreads} threads</li>
                <li><i class="fi-xnluxl-comment"></i> {$countPosts} posts</li>
            </ul>
        </div>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-left">
                    <span class="footer-title">Copyright &copy; AsynCore 2023</span>
                </div>
                <div class="footer-right">
                    <a href="https://friconix.com/" target="_blank" rel="noopener noreferrer" class="friconix">Friconix</a>
                </div>
            </div>
        </div>
    </footer>
    </body>
    </html>
HTML;