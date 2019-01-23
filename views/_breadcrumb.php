<nav aria-label="breadcrumb">
    <ol class="breadcrumb small rounded-0 bg-transparent">
        <?php
        function breadcrumbs() {
            
            $url = str_replace(strtolower(NOME_EMPRESA), "", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            $url = preg_replace("/\d+/u", "", $url);
            
            $path = array_filter(explode('/', $url));
        
            $base = (array_key_exists("HTTPS",$_SERVER) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        
            $breadcrumbs = Array('<li class="breadcrumb-item"><a href="' . BASE_URL . '">Dashboard</a></li>');
        
            // Apenas variáveis podem ser passadas como referências
            $lastlast = array_keys($path);
            $last = end($lastlast);
        
            foreach ($path AS $x => $crumb) {

              $title = ucwords(str_replace(Array('.php', '_'), Array('', ' '), $crumb));

                if ($x != $last)
                    $breadcrumbs[] = '<li class="breadcrumb-item"><a href="' . BASE_URL . '/' . $crumb . '">' . $title . '</a></li>';
                else
                    $breadcrumbs[] = "<li class=\"breadcrumb-item active\" aria-current=\"page\">$title</li>";
            }
        
            return implode($breadcrumbs);
        }

        echo breadcrumbs();
        ?>
    </ol>
</nav>