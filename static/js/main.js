(function ($) {
  Drupal.behaviors.common = {
    attach : function(context, settings) {
        $('[data-submit]', context || '#shop_goods_spa').click(ajaxSubmit);
    }
  };

  Drupal.behaviors.goodsFilter = {
    attach : function(context, settings) {
        actualizeSortableColumnsView($('th.sortable', context || '#shop_goods_spa'));
        
        $('.dropdown-menu', context || '.search-panel ').find('a').click(function(e) {
            e.preventDefault();
            var param = $(this).attr("href").replace("#","");
            var concept = $(this).text();
            $('.search-panel span#search_concept').text(concept);
            $('.input-group #search_param').val(param);
        });


        $('th.sortable', context || '#shop_goods_spa').click(function (e) {
            var $this = $(this),
                $oDirection = $('#orderDirection'),
                $oFName = $('#orderFildName'),
                fName = $this.data('value');

                nextSortClass = '';

            if($oFName.val() !== fName){
                $oDirection.val('ASC');
            }else{
                if($oDirection.val() == 'ASC'){
                    $oDirection.val('DESC');
                }else{
                    $oDirection.val('ASC');
                }
            }
            $oFName.val(fName);

            actualizeSortableColumnsView($this);

            ajaxSubmit.bind(this)();

        });
    }
  };

  Drupal.behaviors.goodsEditers = {
    attach: function (context, settings) {
        // var goodsContantContext = context || '#goodsContantContainer';

        // $('button[data-submit]', goodsContantContext).click(ajaxSubmit);

        $('#shop_goods_edit_form', context).ajaxForm();

        $('#myModal', context).on('hidden.bs.modal', function (e) {
            $('.modal-body').html('');
        });
    }
  };

  function ajaxSubmit() {
      var $target = $(this),
          containerSelector = $target.data('submit-container'),
          path = $target.data('submit'),
          contantSelector = $target.data('submit-update'),
          $targetUpdate = $(contantSelector),
          data = containerSelector ? $(containerSelector+' input') : $target.data('submit-data');

      $.ajax({
          type: 'POST',
          url: path,
          data: data,
          success: function(data){
              $targetUpdate.html(data);
              console.log(contantSelector);
              Drupal.attachBehaviors(contantSelector);
          },
          error: function (err) {
              console.error(err);
          }
      });
  }

  function actualizeSortableColumnsView($sColumns) {
      var $oDirection = $('#orderDirection'),
          $oFName = $('#orderFildName'),
          $tIcon = $sColumns.filter('[data-value="'+$oFName.val()+'"]').find('i'),
          $icons = $sColumns.parent().find('i'),
          actualSortClass = 'glyphicon-sort-by-attributes';

      $icons.removeClass('glyphicon-sort-by-attributes').removeClass('glyphicon-sort-by-attributes-alt').addClass('glyphicon-sort');

      if($oDirection.val() == 'DESC'){
          actualSortClass = 'glyphicon-sort-by-attributes-alt';
      }

      $tIcon.removeClass('glyphicon-sort').addClass(actualSortClass);

  }
})(jQuery);