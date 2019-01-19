<nav aria-label="breadcrumb">
    <ol class="breadcrumb rounded-0 bg-light small">
        <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->

<?php
$url = $_SERVER["REQUEST_URI"];
$url = str_replace("/" . strtolower(NOME_EMPRESA) . "/", "", $url);
$crumbs = explode("/", $url);
for ($i=0; $i < count($crumbs); $i++):
    $currentModule = str_replace(array(".php","_"),array(""," "),$crumbs[$i]) . ' ';
?>
    <li class="breadcrumb-item">
        <a href="<?php echo BASE_URL . "/" . $currentModule ?>">
            <?php echo ucfirst($currentModule) ?>
        </a>
    </li>
<?php endfor ?>

</ol>
</nav>