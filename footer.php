    </div>
    <div id="ErrorBox" class="ErrorBox" draggable="true">
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
        var eHandler = new ErrorHandler();
        (function(){            
            eHandler.displayMessages();
        })();
    </script>
    </body>
</html>