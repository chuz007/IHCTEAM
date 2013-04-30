<?php

class HeaderBuilder
{
    function createHeader()
    {        
        return '<div class="Header_wrapper">
                    <div class="Header">Test Framework</div>
                    <img class="HeaderImage" />
                    '. $this->getUserBox() .'
                </div>';
    }
    
    function getUserBox()
    {
        global $user;
        $userBoxHtml = "";
        if($user->id_user == null)
        {
            $userBoxHtml = '<div id="userBox" class="userBox">
                                <form method="POST" action="index.php">
                                    <table>
                                        <tr>
                                            <td>Username:</td>
                                            <td><input type="text" value="" id="input_username" name="username" /></td>
                                            <td>Password:</td>
                                            <td><input type="password" value="" id="input_password" name="password" /></td>
                                            <td><input type="submit" value="Log In" id="btn_login" /></td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="pointer" id="pointer" value="user/login" />
                                </form>
                            </div>';
        }else
        {
            $userBoxHtml = '<div id="userBox" class="userBox">
                                <form id="logout_form" method="POST" action="index.php">
                                    <table>
                                        <tr>
                                            <td>'. $user->tx_login .'</td>
                                            <td>(<a href="javascript:void(0);" onclick="$(\'#logout_form\').submit();">logout</a>)</td>
                                        </tr>
                                    </table>
                                    <input type="hidden" name="pointer" id="pointer" value="user/logout" />
                                </form>
                            </div>';
        }
        return $userBoxHtml;
    }
}
?>
