<?php

echo <<<HTML
    <footer class="footer">
        <div class="forum-stats desktop-only">
            <ul>
                <li><i class="fa fa-user-circle-o"></i>$count-active-users online</li>
                <li><i class="fa fa-user-o"></i>$count-users registered</li>
                <li><i class="fa fa-comments-o"></i>$count-threads threads</li>
                <li><i class="fa fa-comment-o"></i>$count-posts posts</li>
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