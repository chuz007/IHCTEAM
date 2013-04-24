    </div>
    <div id="ErrorBox" class="ErrorBox">
        <?php echo getDivHeader("ErrorBoxHeader","ErrorBox","ErrorBoxHeader",""); ?>
        <div id="ErrorBoxMessage"> 
        <?php 
            global $errorList;
            foreach($errorList as $e)
            {
                echo $e->toHtml();
            }
        ?>
        </div>        
    </div> 
    <script lang="javascript">
        (function(){
            var eHandler = new ErrorHandler();
            eHandler.displayMessages();
        })();
    </script>
    </body>
</html>