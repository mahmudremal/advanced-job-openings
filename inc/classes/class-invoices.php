<?php
/**
 * Invoices admin manual control page.
 *
 * @package Aquila
 */
namespace FUTUREWORDPRESS_PROJECT\Inc;
use FUTUREWORDPRESS_PROJECT\Inc\Traits\Singleton;

class Invoices {
	use Singleton;
	protected function __construct() {
		$this->setup_hooks();
	}
	protected function setup_hooks() {
		add_action( 'admin_init', [ $this, 'add_menu' ], 10, 0 );
	}
	public function add_menu() {
		// add_submenu_page( 'edit.php?post_type=' . FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, __( 'All Invoices', 'domain' ), __( 'Invoices', 'domain' ), 'edit_post', 'advanced-job-openings-invoices', [ $this, 'invoices_page' ], 5 );
		// add_submenu_page( 'edit.php?post_type=' . FUTUREWORDPRESS_PROJECT_CPT_JOB_OPENINGS, __( 'Settings', 'domain' ), __( 'Invoices', 'domain' ), 'edit_post', 'advanced-job-openings', [ $this, 'invoices_page' ], 5 );
	}
	public function invoices_page() {
		?>
		<?php
		$currentJob = isset( $_GET[ 'job' ] ) ? $_GET[ 'job' ] : false;
		$jobs = $this->jobs( $currentJob );
		$invoices = $this->invoices();
		return;
		?>
		<pre style="display: none;"><?php print_r( $invoices ); ?></pre>
		<div class="template__wrapper background__greyBg px30 py50">
			<div class="fwp-admin-setting-tabs">
				<div id="elements" class="fwp-admin-setting-tab active">
					<form action="<?php echo esc_url( admin_url( 'admin-post.php' ) ); ?>" method="post" id="advanced-job-openings-invoices-form">
						<div class="fwp-global__control mb45">
							<div class="global__control__content">
								<h4>
									<select name="switch-channel" id="switch-channel" onchange="location.href = '<?php echo esc_url( admin_url( 'admin.php?page=advanced-job-openings-invoices&job=' ) ); ?>' + value">
										<?php foreach( $jobs as $id => $title ) : ?>
											<option value="<?php echo esc_attr( $id ); ?>" <?php echo esc_attr( ( isset( $_GET[ 'channel' ] ) && $_GET[ 'channel' ] == $id ) ? 'selected' : '' ); ?>><?php echo esc_html( $title ); ?></option>
										<?php endforeach; ?>
									</select>
								</h4>
								<!-- <p>Use the Toggle Button to Activate or Deactivate all the Elements at once.</p> -->
							</div>
							<!--
								<div class="global__control__switch">
									<label class="fwp-switch fwp-switch--xl">
										<input class="fwp-element-global-switch fwp-toggle-switcher" name="channelId[<?php // echo esc_attr( $playlists[ 'etag' ] ); ?>]" type="checkbox" <?php // echo esc_attr( ( isset( $playlists[ 'is_Public' ] ) && $playlists[ 'is_Public' ] ) ? 'checked' : '' ); ?> data-channel="<?php // echo esc_attr( $currentChannel ); ?>" data-toggle="channelId" data-target="<?php // echo esc_attr( $playlists[ 'etag' ] ); ?>">
										<span class="switch__box"></span>
									</label>
									<span class="switch__status enable"><?php // _e( 'Visible' ); ?></span>
									<span class="switch__status disable"><?php // _e( 'Hide' ); ?></span>
								</div>
								<div class="global__control__button">
									<button type="button" class="fwp-button js-fwp-settings-update" data-channel="<?php // echo esc_attr( ( isset( $_GET[ 'channel' ] ) && isset( $channelList[ $_GET[ 'channel' ] ] ) ) ? '' : $currentChannel ); ?>"><?php // _e( 'Update' ); ?></button>
								</div> -->
						</div>


						<?php if( $this->allow( true ) ) : ?>
							<style>
							</style>
							<div class="fwp-section mb50">
								<h3 class="fwp-section__header"><?php esc_html_e( 'Invoices', 'domain' ); ?></h3>
								<?php
									if( count( $invoices[ 'items' ] ) <= 0 ) {
										?>
										<div class="fwp-tool__card fwp-container fwp-block p30" style="max-width: 100%;width: 100%;">
											<div class="content">
												<h3><?php esc_html_e( 'Nothing found there :(', 'domain' ); ?></h3>
												<p>
													<?php esc_html_e( 'There is nothing on this job.', 'domain' ); ?>
												</p>
											</div>
										</div>
										<?php
									}
								?>
								<div class="fwp-element__wrap">
									<?php
									foreach( $playlists[ 'items' ] as $i => $item ) :
									$snippet = $item[ 'snippet' ];
									$thumb = $this->thumb( $snippet[ 'thumbnails' ], 'medium' );
									?>
									<div class="fwp-element__item ">
										<a href="<?php echo esc_url( $this->yturl( 'playlist', [ 'id' => $item[ 'id' ] ] ) ); ?>" class="element-link" target="_blank" data-embed="<?php echo esc_url( $this->yturl( 'playlist-embed', [ 'p' => $item[ 'id' ] ] ) ); ?>">
											<img class="element-image" src="<?php echo esc_url( $thumb[ 'url'] ); ?>" alt="<?php echo esc_attr( 'Bilinmeyen Günahlar' ); ?>" height="<?php echo esc_attr( $thumb[ 'height'] ); ?>" width="<?php echo esc_attr( $thumb[ 'width'] ); ?>">
										</a>
										<div class="element__content">
											<h4><?php echo esc_html( substr( $snippet[ 'title' ], 0, 45 ) ); ?></h4>
											<div class="element__options">
												<?php if( 1 == 1 || isset( $snippet[ 'description' ] ) && ! empty( $snippet[ 'description' ] ) ) : ?>
												<div class="element__icon" href="javascript:void(0)" data-href="<?php echo esc_url( $this->yturl( 'playlist', [ 'p' => $item[ 'id' ] ] ) ); ?>">
													<i class="ea-admin-icon ic on-monitor dashicons-before dashicons-lightbulb"></i>
													<div class="tooltip-text">
														<div class="tooltip-header">
															<?php if( 1 == 2 ) : ?>
																<select class="changeCategory" name="changeCategory[<?php echo esc_attr( $item[ 'id' ] ); ?>]" type="checkbox" data-channel="<?php echo esc_attr( $currentChannel ); ?>" data-toggle="changeCategory" data-channel="<?php echo esc_attr( $currentChannel ); ?>" data-target="<?php echo esc_attr( $item[ 'id' ] ); ?>">
																	<?php foreach( $are_Category as $catID => $catTitle ) : ?>
																		<option value="<?php echo esc_attr( $catID ); ?>" <?php echo esc_attr( ( isset( $item[ 'is_Category' ] ) && $item[ 'is_Category' ] == $catID ) ? 'selected' : '' ); ?>><?php echo esc_html( $catTitle ); ?></option>
																	<?php endforeach; ?>
																</select>
															<?php endif; ?>
															<i class="ea-admin-icon dashicons-before dashicons-clipboard" data-clipboard="<?php echo esc_attr( $item[ 'id' ] ); ?>"></i>
															<a href="<?php echo esc_url( $this->yturl( 'watch', [ 'p' => $item[ 'id' ] ] ) ); ?>" class="tootip-link" target="_blank"><i class="dashicons-before dashicons-admin-links"></i></a>
														</div>
														<div class="tooltip-body">
															<?php echo esc_html( ( isset( $snippet[ 'description' ] ) && ! empty( $snippet[ 'description' ] ) && ! is_array( $snippet[ 'description' ] ) ) ? substr( $snippet[ 'description' ], 0, 120 ) : __( 'Descriptions Not available.', 'domain' ) ); ?>
														</div>
													</div>
												</div>
												<?php endif; ?>
												<?php if( $this->allow( 'main' ) ) : ?>
													<label class="fwp-switch">
														<input class="fwp-widget-item fwp-elements-list fwp-toggle-switcher" name="playlistId[<?php echo esc_attr( $item[ 'id' ] ); ?>]" type="checkbox" <?php echo esc_attr( ( isset( $item[ 'is_Public' ] ) && $item[ 'is_Public' ] ) ? 'checked' : '' ); ?> data-channel="<?php echo esc_attr( $currentChannel ); ?>" data-toggle="playlistId" data-target="<?php echo esc_attr( $item[ 'id' ] ); ?>">
														<span class="switch__box "></span>
													</label>
												<?php endif; ?>
											</div>
										</div>
									</div>
									<?php endforeach; ?>
								</div>
							</div>
						<?php endif; ?>
					</form>
				</div>
			</div>
		</div>
		<?php
	}
	private function jobs( $job_id = false ) {
		return [];
	}
	private function invoices() {
		return [];
	}
}
