<h1>
    欢迎:
    <?php
//    session存储有关用户会话的信息   在autoload的61行开启session
        $user = $this->session->userdata('user');
        echo $user->name;
    ?>
</h1>