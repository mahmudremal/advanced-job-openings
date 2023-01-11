( function ( $ ) {
	/**
	 * Class Frontend Main JS.
	 */
	class FUTUREWORDPRESS_PROJECT_FROTEND_MAIN {
		/**
		 * Contructor.
		 */
		constructor() {
			this.ajaxUrl = siteConfig?.ajaxUrl ?? '/wp-admin/admin-ajax.php';
			this.ajaxNonce = siteConfig?.ajax_nonce ?? '';
			this.confirmDeleteCV = siteConfig?.confirmdeletecv ?? 'Are you sure you want to delete Your CV? This can\'t be undo.';
			this.confirmDeleteApply = siteConfig?.confirmdeleteapply ?? 'Are you sure you want to delete Your Application? This can\'t be undo.';
			this.confirmDeleteJob = siteConfig?.confirmdeletejob ?? 'Are you sure you want to delete Your Application? This can\'t be undo.';
			this.loadMoreBtn = $( '#load-more' );
			this.loadingTextEl = $( '#loading-text' );
			this.isRequestProcessing = false;

            console.log("Test123")
      
			this.init();
      // this.preload();this.scroll();
      // this.according();this.progress();
		}

		init() {
            this.cv_add();
            this.cv_edit();
            this.cv_delete();
            this.apply_delete();
            this.job_delete();
            this.job_mark();
            this.dataTable();
            this.see_more();
        }
    cv_add() {
      const thisClass = this;
      if( ! window.fwp_form_CV_ADD) {return;}
      var form = window.fwp_form_CV_ADD,
          name = form.name.value,
          file = form.file;
      file.addEventListener( 'change', function( e ) {
        var formData = new FormData();
        if( form.file.dataset.id ) {
          formData.append( 'edit-cv', form.file.dataset.id );
        }
        formData.append( 'action', 'fwp-candidate-add-cv-action' );
        formData.append( 'name', form.name.value );
        formData.append( 'file', $( form.file )[0].files[0] );
        formData.append( '_nonce', thisClass.ajaxNonce );
        $.ajax( {
          url: thisClass.ajaxUrl,
          type: 'POST',
          data: formData,
          processData: false,  // tell jQuery not to process the data
          contentType: false,  // tell jQuery not to set contentType
          dataType: "json",
          success: function( data ) {
            if( data.success ) {
              location.reload();
            } else {
              console.log( data );
            }
          }
        } );
      } );
    }
    cv_edit() {
      document.querySelectorAll( '.edit-cv-fwp' ).forEach( function( e, i ) {
        e.addEventListener( 'click', function( event ) {
            var id = ( this.dataset.id ) ? this.dataset.id : false;
            var name = ( this.dataset.name ) ? this.dataset.name : '';
            if( id ) {
              window.fwp_form_CV_ADD.file.dataset.id = id;
              window.fwp_form_CV_ADD.name.value = name;
              window.fwp_form_CV_ADD.file.click();
            }
        } );
      } );
    }
    cv_delete() {
      const thisClass = this;
      document.querySelectorAll( '.delete-cv-fwp' ).forEach( function( e, i ) {
        e.addEventListener( 'click', function( event ) {
            var id = ( this.dataset.id ) ? this.dataset.id : false;
            var name = ( this.dataset.name ) ? this.dataset.name : '';
            if( id && confirm( thisClass.confirmDeleteCV ) ) {
              var data = { action: 'fwp-candidate-delete-cv-action', id: id, _nonce: thisClass.ajaxNonce };
              if( this.dataset.isCompany ) {
                data.isCompany = this.dataset.isCompany;
                data.action = 'fwp-company-delete-application-action';
              }
              console.log( data );
              $.ajax( {
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function( data ) {
                  if( data.success ) {
                    location.reload();
                  } else {
                    console.log( data );
                  }
                }
              } );
            }
        } );
      } );
    }
    apply_delete() {
      const thisClass = this;
      document.querySelectorAll( '.delete-application-fwp' ).forEach( function( e, i ) {
        e.addEventListener( 'click', function( event ) {
            var id = ( this.dataset.id ) ? this.dataset.id : false;
            var name = ( this.dataset.name ) ? this.dataset.name : '';
            if( id && confirm( thisClass.confirmDeleteApply ) ) {
              var data = { action: 'fwp-candidate-delete-application-action', id: id, _nonce: thisClass.ajaxNonce };
              console.log( data );
              $.ajax( {
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function( data ) {
                  if( data.success ) {
                    location.reload();
                  } else {
                    console.log( data );
                  }
                }
              } );
            }
        } );
      } );
    }
    job_delete() {
      const thisClass = this;
      document.querySelectorAll( '.delete-job-fwp' ).forEach( function( e, i ) {
        e.addEventListener( 'click', function( event ) {
            var id = ( this.dataset.id ) ? this.dataset.id : false;
            var nonce = ( this.dataset.nonce ) ? this.dataset.nonce : '';
            if( id && confirm( thisClass.confirmDeleteJob ) ) {
              var data = { action: 'fwp-company-delete-job-action', job: id, 'fwp-company-delete-job-action': nonce };
              console.log( data );
              $.ajax( {
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function( data ) {
                  if( data.success ) {
                    location.reload();
                  } else {
                    console.log( data );
                  }
                }
              } );
            }
        } );
      } );
    }
    job_mark() {
      const thisClass = this;
      document.querySelectorAll( '.mark-job-fwp' ).forEach( function( e, i ) {
        e.addEventListener( 'click', function( event ) {
            var id = ( this.dataset.id ) ? this.dataset.id : false;
            var markas = ( this.dataset.markas ) ? this.dataset.markas : '';
            var nonce = ( this.dataset.nonce ) ? this.dataset.nonce : '';
            var user_id = ( this.dataset.user_id ) ? this.dataset.user_id : '';
            var job_id = ( this.dataset.job_id ) ? this.dataset.job_id : '';
            var cv_id = ( this.dataset.cv_id ) ? this.dataset.cv_id : '';
            if( id && confirm( 'Are you sure to ' + ( ( markas == 'approved' ) ? 'Approved' : ( ( markas == 'paid' ) ? 'Paid' : 'Proceed' ) ) + '?' ) ) {
              var data = { action: 'fwp-company-approve-job-action', markas: markas, id: id, 'fwp-company-approve-job-action': nonce, user_id: user_id, job_id: job_id, cv_id: cv_id };
              $.ajax( {
                url: thisClass.ajaxUrl,
                type: 'POST',
                data: data,
                // processData: false,
                // contentType: false,
                dataType: "json",
                success: function( data ) {
                  if( data.success ) {
                    location.reload();
                  } else {
                    console.log( data );
                  }
                }
              } );
            }
        } );
      } );
    }
    dataTable() {
      const thisClass = this;
      document.querySelectorAll( '.fwp-datatable' ).forEach( function( e, i ) {
        $( e ).DataTable();
      } );
    }
    see_more() {
      const thisClass = this;
      document.querySelectorAll( '.fwp-see-more' ).forEach( function( e, i ) {
        e.addEventListener( 'click', function( event ) {
            var text = ( this.dataset.text ) ? this.dataset.text : '';
            var textarget = ( this.dataset.textarget ) ? this.dataset.textarget : '';
            if( text != '' && document.querySelector( textarget ) ) {
              document.querySelector( textarget ).innerHTML = text;
            } else {
              if( document.querySelector( textarget ) ) {
                document.querySelector( textarget ).innerHTML = '';
              }
            }
        } );
      } );
    }
    


    
    preload() {
      if($('.preloader').length){
        $('.preloader').delay(200).fadeOut(300);
      }
      $(".preloader_disabler").on('click', function() {
        $("#preloader").hide();
      });
    }
    scroll() {
      $(window).scroll(function(){
        if ($(this).scrollTop() > 600) {
            $('.scrollToHome').fadeIn();
        } else {
            $('.scrollToHome').fadeOut();
        }
      });
      $('.scrollToHome').on('click',function(){
          $('html, body').animate({scrollTop : 0},800);
          return false;
      });
    }
    according() {
      $(document).on('ready', function() {
        $('.collapse').on('show.bs.collapse', function () {
            $(this).siblings('.card-header').addClass('active');
        });

        $('.collapse').on('hide.bs.collapse', function () {
            $(this).siblings('.card-header').removeClass('active');
        });
        
        $(function () {
          $('[data-toggle="tooltip"]').tooltip()
        })
      });
    }
    progress() {
      if($('.progress-levels .progress-box .bar-fill').length){
        $(".progress-box .bar-fill").each(function() {
            var progressWidth = $(this).attr('data-percent');
            $(this).css('width',progressWidth+'%');
            $(this).children('.percent').html(progressWidth+'%');
        });
      }
    }
		handleLoadMorePosts() {
			const page = this.loadMoreBtn.data( 'page' );
			if ( ! page || this.isRequestProcessing ) {
				return null;
			}

			const nextPage = parseInt( page ) + 1;
			this.isRequestProcessing = true;
			$.ajax( {
				url: this.ajaxUrl,
				type: 'post',
				data: {
					page: page,
					action: 'load_more',
					ajax_nonce: this.ajaxNonce,
				},
				success: ( response ) => {
					this.loadMoreBtn.data( 'page', nextPage );
					$( '#load-more-content' ).append( response );
					this.removeLoadMoreIfOnLastPage( nextPage );
					this.isRequestProcessing = false;
				},
				error: ( response ) => {
					console.log( response );
					this.isRequestProcessing = false;
				},
			} );
		}
		
		
		/**
		 * Remove Load more Button If on last page.
		 *
		 * @param {int} nextPage New Page.
		 */
		removeLoadMoreIfOnLastPage( nextPage ) {
			if ( nextPage + 1 > this.totalPagesCount ) {
				this.loadMoreBtn.remove();
			}
		}
		
	}

	new FUTUREWORDPRESS_PROJECT_FROTEND_MAIN();
} )( jQuery );