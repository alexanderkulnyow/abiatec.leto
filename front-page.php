<?php
get_header();
?>
    <main class="container-fluid" role="main">
        <section class="container frontpage__block">
			<?php
			$query = new WP_Query( 'pagename=contact' );

			?>

            <h2 class="text-center">О нас</h2>
            <div class="row align-items-center">
                <div class="col-12 col-md-6"><img class="img-fluid w-100" src="img/about.jpg" alt="alt"></div>
                <div class="col-12 col-md-6">
                    <p>Хотите дать своим детям возможность всесторонне развиваться, почувствовать себя артистами?
                        Запишитесь в музыкальную школу-студию “LETTO” — мы помогаем раскрыть таланты. Предлагаем
                        программы обучения игре на музыкальных инструментах, а также курс вокала, теоретических
                        дисциплин и хореографии для детей от 6 до 18 лет. Мы ждём всех, кто хочет прикоснуться к
                        музыкальному искусству и творчеству.</p>
                </div>
            </div>
        </section>
        <section class="container frontpage__block">
            <h2 class="text-center">Наши курсы</h2>
            <div class="row mb-3 text-center">
				<?php
				// указываем категорию 9 и выключаем разбиение на страницы (пагинацию)
				$query = new WP_Query( array(
					'post_type' => 'courses'
				) );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
                        <div class="card__courses col-12 col-sm-6 col-md-3 border__none">
							<?php if ( has_post_thumbnail() ) { ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php
									$args = array(
										'class' => "img-fluid w-100",
//										'alt'   => trim( strip_tags( $wp_postmeta->_wp_attachment_image_alt ) ),
									);
									the_post_thumbnail( 'medium', $args ); ?>
                                </a>
							<?php } ?>
                            <a href="<?php the_permalink(); ?>">
                                <h3 class="text-left course_link <?php echo get_post_meta( $post->ID, 'meta_select', 1 ) ?>"><?php the_title(); ?></h3>
                            </a>
                        </div>
						<?php
					}
					wp_reset_postdata(); // сбрасываем переменную $post
				} else {
					echo 'Записей нет.';
				}
				?>
            </div>
        </section>
        <section class="container frontpage__block">
            <h2 class="text-center">Как начать обучаться у нас?</h2>
            <div class="row align-items-center">
				<?php
				$start_learning_n = array(
					'start_learning_1',
					'start_learning_2',
					'start_learning_3',
					'start_learning_4'
				);
				$i                = 1;
				foreach ( $start_learning_n as $start_learning ) {
					echo '<div class="col-12 col-sm-6 col-md-3">
                    <div class="start_learning">
					     <span> ' . $i ++ . ' </span>';
					echo '<p class="start_learnig_1">' . nl2br( esc_html( get_theme_mod( $start_learning, 'текст по умолчанию' ) ) ) . '</p>';
					echo '    </div>
                </div>';
				}
				?>

            </div>
        </section>
        <section class="container frontpage__block">
            <h2 class="text-center">Наши преподаватели</h2>
            <div class="row mb-3 text-center">
				<?php
				$query = new WP_Query( array(
					'category_name' => 'staff'
				) );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
                        <div class="card mb-3 shadow-sm col-12 col-sm-6 col-md-3 border__none">
							<?php if ( has_post_thumbnail() ) { ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php $args = array(
										'class' => "img-fluid w-100",
//										'alt'   => trim( strip_tags( $wp_postmeta->_wp_attachment_image_alt ) ),
									);
									the_post_thumbnail( 'medium', $args ); ?>
                                </a>
							<?php } ?>
                            <a href="<?php the_permalink(); ?>">
                                <h3 class="staff__h3">
									<?php the_title(); ?>
                                </h3>
                            </a>


                            <div class="text-left mb-2">
								<?php echo the_excerpt(); ?>
                            </div>
                            <a class="text-right" href="<?php the_permalink(); ?>" target="_blank">Подробнее</a>


                        </div>
						<?php
					}
					wp_reset_postdata(); // сбрасываем переменную $post
				} else {
					echo 'Записей нет.';
				}
				?>

            </div>
        </section>
        <section class="container-fluid frontpage__block">
            <h2 class="text-center">Наши концерты</h2>
            <ul class="slick__navigations">
                <li class="slick__prev">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/arrrow.png" alt="">
                </li>
                <li class="slick__next">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/icons/arrrow.png" alt="">
                </li>
            </ul>
            <div class="row align-items-center slick__container">
				<?php
				$query = new WP_Query( array(
//		            'post_type' => 'post',
					'category_name' => 'concerts'
				) );
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						?>
                        <div class="">
							<?php if ( has_post_thumbnail() ) { ?>
                                <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
									<?php the_post_thumbnail(); ?>
                                </a>
								<?php
							} ?>
                        </div>
						<?php
					}
					echo '  </div > ';
					wp_reset_postdata();
				} else {
					echo 'Записей нет . ';
				}
				?>
        </section>
        <section class="container frontpage__block d-none">
            <h2 class="text-center">Стоимость</h2>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th csope="col"></th>
                    <th csope="col">Индивидуальные</th>
                    <th csope="col">Групповые сольфеджио</th>
                    <th csope="col">Хореография (3-4 человека)</th>
                    <th csope="col">Хореография (более человек)</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th csope="row">1 занятие в неделю (60 мин)</th>
                    <td>18</td>
                    <td>12</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th csope="row">1 занятие в неделю (45 мин)</th>
                    <td></td>
                    <td>15</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <th csope="row">1 занятие в неделю (35 мин)</th>
                    <td>13</td>
                    <td>12</td>
                    <td>12</td>
                    <td>10</td>
                </tr>
                </tbody>
            </table>
        </section>
        <section class="container frontpage__block">
            <h2 class="text-center">Где мы находимся?</h2>
            <div class="row align-items-start">
                <div class="col-12 col-md-8"><img class="img-fluid" src="img/map.png"></div>
                <div class="col-12 col-md-4">
                    <p>г. Минск, ул. Восточная д. 40 (гимназия №6)</p>
                    <p>г. Минск, ул. Восточная д. 40 (гимназия №6)</p>
                    <p>г. Минск, ул. Восточная д. 40 (гимназия №6)</p>
                    <p>г. Минск, ул. Восточная д. 40 (гимназия №6)</p>
                    <p>г. Минск, ул. Восточная д. 40 (гимназия №6) </p>
                </div>
            </div>
        </section>
        <section class="container frontpage__block">
            <h2 class="text-center">Отзывы</h2>
            <div class="row align-items-start">
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-start testimonial"><img src="img/ts.png">
                        <div class="d-flex flex-column">
                            <p class="mb-0">Долго искали студию, в которой ребенок сможет быть раскрепощенным и будет
                                заниматься вокалом с удовольствием. Рады, что попали к педагогу...Подробнее</p>
                            <h6 class="mb-0 text-right bold">Мама Андреевой Полины (6 лет)</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-start testimonial"><img src="img/ts.png">
                        <div class="d-flex flex-column">
                            <p class="mb-0">Долго искали студию, в которой ребенок сможет быть раскрепощенным и будет
                                заниматься вокалом с удовольствием. Рады, что попали к педагогу...Подробнее</p>
                            <h6 class="mb-0 text-right bold">Мама Андреевой Полины (6 лет)</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-start testimonial"><img src="img/ts.png">
                        <div class="d-flex flex-column">
                            <p class="mb-0">Долго искали студию, в которой ребенок сможет быть раскрепощенным и будет
                                заниматься вокалом с удовольствием. Рады, что попали к педагогу...Подробнее</p>
                            <h6 class="mb-0 text-right bold">Мама Андреевой Полины (6 лет)</h6>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="d-flex align-items-start testimonial"><img src="img/ts.png">
                        <div class="d-flex flex-column">
                            <p class="mb-0">Долго искали студию, в которой ребенок сможет быть раскрепощенным и будет
                                заниматься вокалом с удовольствием. Рады, что попали к педагогу...Подробнее</p>
                            <h6 class="mb-0 text-right bold">Мама Андреевой Полины (6 лет)</h6>
                        </div>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary align-items-end" type="button">Учавствовать</button>
        </section>
        <section class="container frontpage__block">
            <h2 class="text-center">Оставить заявку на пробный урок</h2>
            <div class="row align-items-start">
                <div class="col-12 col-md-6"></div>
                <div class="col-12 col-md-6"><img class="img-fluid" src="img/phone.jpg"></div>
            </div>
        </section>
    </main>
<?php get_footer();
