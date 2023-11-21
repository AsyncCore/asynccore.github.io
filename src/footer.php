<?php
    
    use src\utils\Online;
    
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    $usersOnline = Online::who();
    $countUsersRegistered = '0';
    $countThreads = '0';
    $countPosts = '0';
    
    echo <<<HTML
    <footer class="footer">
        <div class="forum-stats desktop-only">
            <ul>
                <li><i class="fa fa-user-circle-o"></i> {$usersOnline} online</li>
                <li><i class="fa fa-user-o"></i> {$countUsersRegistered} registered</li>
                <li><i class="fa fa-comments-o"></i> {$countThreads} threads</li>
                <li><i class="fa fa-comment-o"></i> {$countPosts} posts</li>
            </ul>
        </div>
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-left">
                    <span class="text-muted">Copyright &copy; AsynCore 2023</span>
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