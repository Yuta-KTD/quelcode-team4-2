<?php

?>
<?= $this->Html->css('moviesinfo.css'); ?>
<div class="movie-info-wrap">
    <div class="movie-info-menu">
        <p class="scheduel-text">上映スケジュール</p>
        <!-- spanは縦線 -->
        <ul>
            <li class="info-menu" value="<?php echo $weekValue[0] ?>"><?php echo $weekDate[0] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[1] ?>"><?php echo $weekDate[1] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[2] ?>"><?php echo $weekDate[2] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[3] ?>"><?php echo $weekDate[3] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[4] ?>"><?php echo $weekDate[4] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[5] ?>"><?php echo $weekDate[5] ?><span></span></li>
            <li class="info-menu" value="<?php echo $weekValue[6] ?>"><?php echo $weekDate[6] ?></li>
        </ul>
        <!-- 今は適当に日付入れてあとからヘルパー -->
        <p id="scheduled-date"><?php echo $weekDate[0] ?></p>

        <div id="movie-main-area">

            <?php foreach ($MovieList as $info) : ?>
                <div class="movie-list">
                    <div class="movie-list-head">
                        <p class="movie-title"><?= h($info->title) ?></p>
                        <p class="movie-screening-time">[ 上映時間 : <?= h($info->total_minutes_with_trailer) ?>分 ]</p>
                        <p class="movie-scheduled-to-end">
                            <?php
                            $today = date("m月d日", strtotime($info->screening_end_date));
                            $today_w = date("w", strtotime($info->screening_end_date));
                            $week = array("日", "月", "火", "水", "木", "金", "土");
                            ?>
                            <?= h($today . "(" . $week[$today_w] . ")終了予定") ?></p>
                    </div>
                    <!-- ======================= 1block チケット購入 ======================= -->
                    <div class="movie-list-main">
                        <p class="movie-img"><?php echo $this->Html->image($info->thumbnail_path); ?></p>
                        <?php $schedules_value = ''; ?>
                        <?php for ($i = 0; $i < count($onThatDayMovieSchedules); $i++) : ?>
                            <?php if ($info->id === $onThatDayMovieSchedules[$i]['movie_id']) : ?>
                                <div class="movie-schedule-for-the-day">
                                    <p class="movie-time">00:00~00:00</p>
                                    <p class="buy-button">予約購入</p>
                                    <?php $schedules_value = 'exists'; ?>
                                </div>
                            <?php elseif ($info->id !== $onThatDayMovieSchedules[$i]['movie_id'] && $schedules_value === '') : ?>
                                <?php $schedules_value = 'none'; ?>
                            <?php endif; ?>
                        <?php endfor; ?>
                        <?php if ($schedules_value === 'none') : ?>
                            <p class="not-movie-schedule-for-the-day">Coming Soon...</p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<?= $this->Html->script('moviesinfo.js') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-3.5.1.min.js') ?>
