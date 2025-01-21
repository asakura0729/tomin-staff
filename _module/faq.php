<section class="border-bottom">
    <header class="bg-contrast">
        <h3 class="mb-0 p-0">
            <button class="btn btn-acd color-white w-100 text-left pt-3 pb-3 pr-5 collapsed" type="button" data-toggle="collapse" data-target="#<?php echo $id; ?>">
                <span class="color-white pr-5"><span class="badge badge-light mr-2 pl-2 pr-2">Q</span><?php echo $q; ?></span>
            </button>
        </h3>
    </header>
    <div id="<?php echo $id; ?>" class="collapse bg-contrast">
        <div class="pl-3 pr-3 pb-3">
            <div class="bg-white p-3 line-height-2">
                <span class="font-size-2 color-gray">A.</span><?php echo $a; ?>
            </div>
        </div>
    </div>
</section>