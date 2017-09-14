@if(Session::has('success'))
    <style type="text/css">
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }
    </style>
    <div class="alert alert-success" id="j-alert-success">
        <strong>
            成功！
        </strong>
        <?php
            $msg = Session::get('success');
            if($msg != 'success') {
                echo $msg;
            }
        ?>
    </div>
    <script type="text/javascript">
        setTimeout(function() {
            document.getElementById('j-alert-success').style.display = 'none';
        }, 1800);
    </script>
@endif