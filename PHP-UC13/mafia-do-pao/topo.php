<?php
session_start();
$nomeusuario = $_SESSION['nomeusuario'];
?>

        <div class="topo">
            <?php
                if ($nomeusuario != null) {
                ?>
              <label>LOGIN: <?= strtoupper($nomeusuario)?></label>
            <?php
                }
                else {
                    echo"<script>window.alert('USUARIO NÃO LOGADO');window.location.href='login.php';</script>";
                }
            ?>
            <a href="backoffice.php"><img src='icons/Navigation-left-01-256.png'width="50" height="50"></a>
        </div>