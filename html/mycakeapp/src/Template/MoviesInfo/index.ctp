<?php

?>
<?= $this->Html->css('moviesinfo.css'); ?>
<div class="movie-info-wrap">
    <div class="movie-info-menu">
        <p class="scheduel-text">上映スケジュール</p>
        <!-- ================== 日付が並んでいる部分 start ================== -->
        <ul>
            <?php for ($i = 0; $i < 7; $i++) : ?>
                <?php if (strpos($weekDate[$i], '水') !== false && strpos($weekDate[$i], '01日') !== false) : ?>
                    <li class="info-menu" value="<?php echo $weekValue[$i] ?>"><?php echo $weekDate[$i] ?>
                        <p class="info-menu-sub">子供女性シニア割引</p>
                        <p class="info-menu-sub">ファーストデイ割引</p>
                        <?php if ($i !== 6) : ?>
                            <!-- spanは縦線 -->
                            <span></span>
                        <?php endif; ?>
                    </li>
                <?php elseif (strpos($weekDate[$i], '水') !== false) : ?>
                    <li class="info-menu" value="<?php echo $weekValue[$i] ?>"><?php echo $weekDate[$i] ?>
                        <p class="info-menu-sub">子供女性シニア割引</p>
                        <?php if ($i !== 6) : ?>
                            <span></span>
                        <?php endif; ?>
                    <?php elseif (strpos($weekDate[$i], '01日') !== false) : ?>
                    <li class="info-menu" value="<?php echo $weekValue[$i] ?>"><?php echo $weekDate[$i] ?>
                        <p class="info-menu-sub">ファーストデイ割引</p>
                        <?php if ($i !== 6) : ?>
                            <span></span>
                        <?php endif; ?>
                    <?php else : ?>
                    <li class="info-menu" value="<?php echo $weekValue[$i] ?>"><?php echo $weekDate[$i] ?>
                        <?php if ($i !== 6) : ?>
                            <span></span>
                        <?php endif; ?>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>
            <!-- ================== 日付が並んでいる部分 end ================== -->

        </ul>
        <p id="scheduled-date"><?php echo $weekDate[0] ?></p>

        <div id="movie-main-area">

            <!-- 映画の予定をforeachで取り出す -->
            <?php foreach ($MovieList as $info) : ?>
                <div class="movie-list">

                    <!-- =========== タイトル、上映時間 終了予定 start =========== -->
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
                    <!-- =========== タイトル、上映時間 終了予定 end =========== -->


                    <!-- ======================= 映画の画像 映画のスケジュール start ======================= -->
                    <div class="movie-list-main">
                        <p class="movie-img"><?php echo $this->Html->image($info->thumbnail_path); ?></p>
                        <?php $schedules_value = ''; ?>


                        <?php for ($i = 0; $i < count($onThatDayMovieSchedules); $i++) : ?>
                            <?php if ($info->id === $onThatDayMovieSchedules[$i]['movie_id']) : ?>
                                <div class="movie-schedule-for-the-day">

                                    <!-- =========== 時間 start =========== -->
                                    <?php
                                    $start_timestamp = strtotime($onThatDayMovieSchedules[$i]['screening_start_datetime']);
                                    $start_datetime = date('YmdHis', $start_timestamp);

                                    $end_timestamp = strtotime($start_datetime . '+' . $info->total_minutes_with_trailer . 'minute');
                                    $end_datetime = date('YmdHis', $end_timestamp);

                                    $start_datetime_hour = substr($start_datetime, 8, 2);
                                    $start_datetime_minutes = substr($start_datetime, 10, 2);

                                    $end_datetime_hour = substr($end_datetime, 8, 2);
                                    $end_datetime_minutes = substr($end_datetime, 10, 2);

                                    $start_time = $start_datetime_hour . ':' . $start_datetime_minutes;
                                    $end_time = $end_datetime_hour . ':' . $end_datetime_minutes;
                                    ?>
                                    <!-- =========== 時間 end =========== -->

                                    <p class="movie-time"><?php echo ($start_time . '~' . $end_time) ?></p>
                                    <p class="buy-button">
                                        <?= $this->Html->link(__('予約購入'), ['controller' => 'bookings', 'action' => 'add_seat', $onThatDayMovieSchedules[$i]['id']]); ?>
                                    </p>

                                    <?php $schedules_value = 'exists'; ?>
                                </div>
                                <!-- $schedules_valueが'exists'だったらその映画のスケジュールが入っていると判断 -->
                            <?php elseif ($info->id !== $onThatDayMovieSchedules[$i]['movie_id'] && $schedules_value === '') : ?>
                                <?php $schedules_value = 'none'; ?>
                            <?php endif; ?>
                        <?php endfor; ?>

                        <!-- $schedules_valueが'none'だったらその映画のスケジュールが入っていないと判断 -->
                        <?php if ($schedules_value === 'none') : ?>
                            <p class="not-movie-schedule-for-the-day">Coming Soon...</p>
                        <?php endif; ?>
                        <!-- ======================= 映画の画像 映画のスケジュール start ======================= -->
                    </div>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</div>
<?= $this->Html->script('moviesinfo.js') ?>
<?= $this->Html->script('https://code.jquery.com/jquery-3.5.1.min.js') ?>
