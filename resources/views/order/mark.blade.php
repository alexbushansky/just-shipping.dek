



<div id = "sendMark" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">

                <h5 class="modal-title">Оцените сотрудничество</h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post">
                @csrf
                <input type="text" name="raiting">
                <div class="modal-body">
                    <div class="success-message">

                    </div>
                    <div class="star-raiting">
                        <div data-raiting="1" class="star"></div>
                        <div data-raiting="2" class="star"></div>
                        <div data-raiting="3" class="star"></div>
                        <div data-raiting="4" class="star"></div>
                        <div data-raiting="5" class="star"></div>
                        <div class="star-raiting-bg"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Оценить</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
    .star-raiting
    {
        position: relative;
        height: 30px;
        z-index: 10;
        width: 131px;
        display: flex;
    }
    .star-raiting img
    {
        display: inline-block;

    }
    .star-raiting-bg
    {
        background-color: orange;
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 0;


    }

    .star
    {
        background: url("/img/star-invert.svg") center center no-repeat;
        width: 30px;
        height: 30px;
        display: inline-block;
        z-index: 100;
        margin-right: -4px;

    }
    .star:hover,.star.active
    {
        background-color: orange;
        transition: 0.5s all ease;
        cursor: pointer;
    }
</style>


