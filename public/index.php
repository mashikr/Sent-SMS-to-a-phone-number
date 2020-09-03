<?php require_once '../includes/header.php'; ?>
<?php
use Twilio\Rest\Client;
    if (isset($_POST['send'])) {

        try {
            $client = new Client(S_ID, TOKEN);
            $client->messages->create(
                $_POST['number'],
                array(
                    'from' => NUMBER,
                    'body' => $_POST['text']
                )
            );

            $_SESSION['msg'] = '<div class="alert alert-success alert-dismissable fade show">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    <strong>Success</strong> to send message.
                                </div>';
                                
        } catch(Exception $e) {
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissable fade show">
                                    <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
                                    This number isn\'t verified.
                                </div>';
        }
        header('Location: index.php');
    }
?>

<div class="row justify-content-center">
    <div class="col-sm-8 col-md-6 col-lg-4 mt-2">
        <?php 
            if (isset($_SESSION['msg'])) {
                echo $_SESSION['msg'];
            }
        ?>
        <div class="card mt-4">
            <div class="card-body">
                <form action="" method="post">
                    <div class="form-group">
                        <label for="number">Phone no</label>
                        <input type="text" class="form-control" name="number" required>
                    </div>
                    <div class="form-group">
                        <label for="text">Text</label>
                        <textarea name="text" id="" class="form-control"  rows="5" required></textarea>
                    </div>
                    <input type="submit" class="btn btn-info" name="send" value="Send">
                </form>
            </div>
        </div>
    </div>
</div>

<?php require_once '../includes/footer.php'; ?>