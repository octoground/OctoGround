<?php

use yii\helpers\Url;
?>
<div class="left flex transition3s">
    <div>
        <div class="header el">
            <div class="mobile">
                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" version="1.1" viewBox="0 0 32 32">
                    <g transform="scale(2)">
                        <circle style="fill:#f44336" cx="8" cy="8" r="7" />
                        <rect style="fill:#ffffff" width="2" height="10" x="-.98" y="-16.29" transform="rotate(135)" />
                        <rect style="fill:#ffffff" width="2" height="10" x="-12.29" y="-5.01" transform="rotate(-135)" />
                    </g>
                </svg>
            </div>
            <p><?= $author->job->title ?></p>
            <span><?= $author->fio ?></span>
        </div>
        <div class="body el">
            <?= $author->desc ?>
        </div>
        <!-- <div class="social flex el">
            <a href="https://t.me/OctoGround" target="_blank">
                <svg width="32px" height="32px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z" />
                </svg>
            </a>
            <a href="https://t.me/OctoGround" target="_blank">
                <svg width="32px" height="32px" viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                    <path d="M29.919 6.163l-4.225 19.925c-0.319 1.406-1.15 1.756-2.331 1.094l-6.438-4.744-3.106 2.988c-0.344 0.344-0.631 0.631-1.294 0.631l0.463-6.556 11.931-10.781c0.519-0.462-0.113-0.719-0.806-0.256l-14.75 9.288-6.35-1.988c-1.381-0.431-1.406-1.381 0.288-2.044l24.837-9.569c1.15-0.431 2.156 0.256 1.781 2.013z" />
                </svg>
            </a>
        </div> -->
    </div>
</div>
<div class="right transition3s">
    <img src="<?= Url::to([$author->img]) ?>" alt="<?= $author->fio ?>">
</div>