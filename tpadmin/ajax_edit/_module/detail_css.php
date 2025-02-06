<link href="https://cdn.jsdelivr.net/npm/quill@2.0.3/dist/quill.snow.css" rel="stylesheet">
<style>
    .l-form-wrap {
        padding-top: 2rem;
        padding-bottom: 20vh;
    }

    .l-submit {
        position: fixed;
        bottom: 0;
        right: 100px;
        width: 400px;
        z-index: 2000;
        border-radius: .25rem;
    }

    .l-submit-inner {
        height: 60px;
        border: 3px solid #fff;
    }

    .l-archive {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        padding-top: 0;
        z-index: 200;
        transform: translate(0, 0);
        transition-duration: 0.25s;
        transition-timing-function: ease;
    }

    .ql-container {
        height: 200px;
    }

    .is-disabled {
        pointer-events: none;
        opacity: 0.75;
    }
</style>