<?php
    use src\utils\Online;
    use src\managers\UserManager;
    use src\db\DatabaseConnection;
    use src\managers\PostsManager;
    use src\managers\ThreadManager;
    
    $db = DatabaseConnection::getInstance()->getConnection();
    $threadManager = new ThreadManager($db);
    $postManager = new PostsManager($db);
    $userManager = new UserManager($db);
    $usersOnline = Online::who();
    $usersOnline = $usersOnline == 1 ? $usersOnline . ' usuario online' : $usersOnline . ' usuarios online';
    $countUsersRegistered = $userManager->userCount();
    $countUsersRegistered = $countUsersRegistered == 1 ? $countUsersRegistered . ' usuario registrado' : $countUsersRegistered . ' usuarios registrados';
    $countThreads = $threadManager->getThreadCount();
    $countPosts = $postManager->getPostCount();
    
?>
<footer class="footer">
    <div class="footer-container">
    <div class="forum-stats desktop-only">
        <ul>
            <li><i class="fi-xnsuxl-power-solid" style="margin-right: 5px"></i><?= $usersOnline ?></li>
            <li><i class="fi-xnsuxl-user-solid" style="margin-right: 5px"></i><?= $countUsersRegistered ?></li>
            <li><i class="fi-xnsuxl-comment-dots-solid" style="margin-right: 5px"></i><?= $countThreads ?> hilos</li>
            <li><i class="fi-xnluxl-comment" style="margin-right: 5px"></i><?= $countPosts ?> posts</li>
        </ul>
    </div>
    </div>
    <div class="footer-container">
        <div class="footer-content">
            <div class="footer-left">
                <span>Copyright &copy; AsynCore 2023</span>
            </div>
            <div class="footer-right">
                <a href="https://friconix.com/" target="_blank" rel="noopener noreferrer" class="friconix">Friconix</a>
            </div>
        </div>
    </div>
</footer>
</body>
</html>