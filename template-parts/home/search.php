<section class="search">
    <div class="container">
        <div class="search__head">
            <?php if (!empty($fields['search_title'])) { ?>
                <h2 class="search__title title">
                    <?php echo $fields['search_title']; ?>
                </h2>
            <?php } ?>
            <?php if (!empty($fields['search_text'])) { ?>
                <div class="search__subtitle subtitle">
                    <?php echo $fields['search_text']; ?>
                </div>
            <?php } ?>
        </div>
        <form role="search" method="get" id="searchform" class="search__form" action="http://fanvue.local/">
            <div class="search__form_body">
                <input type="text" value="" name="s" id="s" class="search__input">
                <input type="submit" class="search__btn">
            </div>
        </form>
        <?php if (!empty($fields['search_buttons'])) { ?>
            <div class="search__buttons">
                <?php foreach ($fields['search_buttons'] as $button) {
                    echo link_html($button['link'] ?? [], 'search__button btn');
                } ?>
            </div>
        <?php } ?>
    </div>
</section>