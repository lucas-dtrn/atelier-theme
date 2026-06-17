<?php
/*------------------------------------*/
/* Block name: 	Terminübersicht */
/*------------------------------------*/

$id = $block['anchor'] ?? $block['id'];

// ACF Fields
$uberschrift_h1 = get_field("uberschrift_h1");
$subline = get_field("subline");
$beschreibung = get_field("beschreibung");

$colors = [
    'course-child' => 'text-cyan-400',
    'course-adult' => 'text-indigo-600',
    'workshop' => 'text-red-500',
    'holiday_workshop' => 'text-yellow-500',
];

$categories = array_keys($colors);

$filterButtonLabels = array(
    'course-child' => array(
        'label' => 'Kurse',
        'group' => array(
            'value' => 'child',
            'label' => 'Kind',
        )
    ),
    'course-adult' => array(
        'label' => 'Kurse',
        'group' => array(
            'value' => 'adult',
            'label' => 'Erwachsene',
        )
    ),
    'workshop' => array(
        'label' => 'Workshops',
    ),
    'holiday_workshop' => array(
        'label' => 'Ferienprogramm',
    ),
);

$target_month = date('n'); // Aktueller Monat
$target_year = date('Y'); // Aktuelles Jahr

$calendarGrid = getCalendarGrid($target_year, $target_month);
?>

<div id="<?php echo $id; ?>" class="hero-rounded hero-rounded--date-overview">

    <?php get_template_part('components/header-bar', '', array('type' => $websitMode, 'color' => 'white', 'drop' => false, 'hero' => true)); ?>

    <div class="hero-rounded__content">

        <div class="hero-rounded__text">
            <?php if (!empty($uberschrift_h1)) : ?>
                <h1><?= $uberschrift_h1 ?></h1>
            <?php endif; ?>

            <?php if (!empty($subline)) : ?>
                <h5><?= $subline ?></h5>
            <?php endif; ?>

            <?php if (!empty($beschreibung)) : ?>
                <p><?= $beschreibung ?></p>
            <?php endif; ?>
        </div>

        <div id="date-overview__calendar" class="date-overview__calendar" data-sceleton="true">

            <!-- Month controls -->
            <button type="button" id="calendar__prev" class="date-overview__calendar__prev" data-active="false">
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M5.75 9L1.75 5L5.75 1" stroke="#001E34" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>
            <div class="date-overview__calendar__month">
                <div id="calendar__month-slider" class="date-overview__calendar__month-slider swiper">
                    <div class="swiper-wrapper"></div>
                </div>
            </div>
            <button type="button" id="calendar__next" class="date-overview__calendar__next" data-active="true">
                <svg width="7" height="10" viewBox="0 0 7 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.25 1L5.25 5L1.25 9" stroke="#001E34" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
            </button>

            <!-- Weekdays -->
            <?php $weekdays = ['Mo', 'Di', 'Mi', 'Do', 'Fr', 'Sa', 'So']; ?>
            <?php foreach ($weekdays as $weekday) : ?>
                <span class="date-overview__calendar__weekday">
                    <span><?php echo $weekday ?></span>
                </span>
            <?php endforeach; ?>

            <!-- Days -->
            <div id="date-overview__calendar__days" class="date-overview__calendar__days">
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
                <button class="date-overview__calendar__day"></button>
            </div>
        </div>

    </div>

    <?php get_template_part('components/paper'); ?>
    <div class="hero-rounded__circle--new"></div>
</div>

<div class="inner">
    <div class="date-overview__content">
        <div id="date-overview__selector" class="date-overview__selector">
            <label data-sceleton="true">
                <div class="image">
                    <img template-product-image></img>
                </div>

                <div class="text">
                    <p template-product-title class="title"></p>
                    <span template-product-category class="category"></span>
                </div>

                <svg class="icon" width="12" height="24" viewBox="0 0 12 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11 7.13156L6 1.8684L1 7.13156" stroke="#001E34" stroke-width="2.3" stroke-linejoin="round" />
                    <path d="M11 17.1316L6 22.1316L1 17.1316" stroke="#001E34" stroke-width="2.3" stroke-linejoin="round" />
                </svg>

                <select>
                    <option value="">Produkt auswählen ...</option>
                </select>
            </label>

            <div class="weekdays"></div>

            <span class="cta">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 11C8.76142 11 11 8.76142 11 6C11 3.23858 8.76142 1 6 1C3.23858 1 1 3.23858 1 6C1 8.76142 3.23858 11 6 11Z" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 8V6" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M6 4H6.005" stroke="white" stroke-width="1.2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                Wähle ein Kunstangebot
            </span>
        </div>

        <div id="date-overview__filter" class="date-overview__filter">
            <?php foreach ($categories as $category) :
                $filterButtonLabel = $filterButtonLabels[$category];
            ?>
                <div id="date-overview__filter__button" class="date-overview__filter__button" style="color:var(--color-<?= $category ?>)" data-category="<?= $category ?>">
                    <div class="dot">
                        <div></div>
                    </div>
                    <p class="label">
                        <b><?= $filterButtonLabel['label'] ?></b>
                        <span><?= isset($filterButtonLabel['group']) ? 'für ' . $filterButtonLabel['group']['label'] : '' ?></span>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>

        <div id="date-overview__list" class="date-overview__list">
            <div class="date-overview__list__item" data-sceleton="true">
                <div class="date"></div>
                <div class="content"></div>
            </div>
            <div class="date-overview__list__item" data-sceleton="true">
                <div class="date"></div>
                <div class="content"></div>
            </div>
            <div class="date-overview__list__item" data-sceleton="true">
                <div class="date"></div>
                <div class="content"></div>
            </div>
            <div class="date-overview__list__item" data-sceleton="true">
                <div class="date"></div>
                <div class="content"></div>
            </div>
            <div class="date-overview__list__item" data-sceleton="true">
                <div class="date"></div>
                <div class="content"></div>
            </div>
        </div>
    </div>
</div>

</div>

<div class="space-extralarge"></div>

<template id="template--date-overview__list__item">
    <div id="date-overview__list__item" class="date-overview__list__item">
        <div class="date">
            <div template-weekday class="month"></div>
            <div template-day class="day"></div>
            <div template-month class="month"></div>
        </div>
        <div class="content">
            <div class="text">
                <a template-title class="title" target="_blank"></a>
                <div template-time class="category"></div>
            </div>
            <div class="buttons">
                <button template-filter-button class="filter" role="button">
                    <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M15 1H1L6.6 7.83222V12.5556L9.4 14V7.83222L15 1Z" stroke="#042135" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </button>
                <a template-booking-button class="book" target="_blank">
                    <svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M12.375 13.125L8 10L3.625 13.125V3.125C3.625 2.79348 3.7567 2.47554 3.99112 2.24112C4.22554 2.0067 4.54348 1.875 4.875 1.875H11.125C11.4565 1.875 11.7745 2.0067 12.0089 2.24112C12.2433 2.47554 12.375 2.79348 12.375 3.125V13.125Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</template>

<template id="template--date-overview__list__month">
    <div id="date-overview__list__month" class="date-overview__list__month">
        <span template-label></span>
        <div></div>
    </div>
</template>

<template id="template--date-overview__calendar__day--filled">
    <button type="button" id="date-overview__calendar__day--filled" class="date-overview__calendar__day --filled">
        <time>
            <span template-day></span>
            <div id="date-overview__calendar__day__slide__color-container" class="date-overview__calendar__day__slide__color-container"></div>
        </time>
    </button>
</template>

<template id="template--date-overview__calendar__day__color-slice">
    <div id="date-overview__calendar__day__color-slice" class="date-overview__calendar__day__color-slice"></div>
</template>

<template id="template--date-overview__calendar__day--empty">
    <button id="date-overview__calendar__day--empty" type="button" class="date-overview__calendar__day --empty">
        <time template-day></time>
    </button>
</template>

<template id="template--date-overview__calendar__day--other-month">
    <button id="date-overview__calendar__day--other-month" type="button" class="date-overview__calendar__day --other-month">
        <time template-day></time>
    </button>
</template>