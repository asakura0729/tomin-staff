<div class="w-lg-800px mx-auto">
    <h1 class="text-center pb-4 font-weight-bold"><?php echo $title; ?></h1>
    <?php if ($errorFlag === true) : ?>
        <div class="alert alert-danger" role="alert">
            エラー：IDまたはパスワードが違います
        </div>
    <?php endif; ?>
    <div class="bg-white border p-4">
        <form method="post">
            <div class="form-group">
                <label class="font-size-middle-l font-weight-bold">ログインID</label>
                <input type="text" name="id" class="form-control" value="" maxlength="40">
            </div>
            <div class="form-group">
                <label class="font-size-middle-l font-weight-bold">パスワード</label>
                <input type="password" name="password" class="form-control" value="" maxlength="20">
            </div>
            <div class="pt-3 pb-3">
                <input type="hidden" name="login" value="1">
                <button type="submit" class="btn bg-contrast btn-lg btn-block w-50 mx-auto"><span class="color-white">ログイン</span></button>
            </div>
        </form>
    </div>
</div>