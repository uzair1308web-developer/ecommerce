(function ($) {
  'use strict';

  // aos
  AOS.init({
    duration: 1500,
  });

  // drawer menu
  $('.open-submenu').on('click', function () {
    $(this).parent().siblings('.submenu-transform').addClass('active');
  });

  $('.btn-menu-back').on('click', function () {
    $(this).closest('.submenu-transform').removeClass('active');
  });

  // header search
  $('.icon-search, .search-close').on('click', function () {
    $('.search-wrapper').toggleClass('search-appear');
  });

  // quickview slider initiation
  $('#quickview-modal').on('shown.bs.modal', function (e) {
    $('.qv-large-slider').slick('setPosition');
    $('.qv-thumb-slider').slick('setPosition');
  });

  // common slider
  $('.common-slider').each(function () {
    var $this = $(this);
    var verticalSlide = $(this).attr('data-vertical-slider');

    if ($this.children().length > 1) {
      var selectorAppendDots = $this.parent().find('.activate-dots');
      var selectorAppendArrows = $this.parent().find('.activate-arrows');
      var selectorPrevArrow = `<span class="arrow-slider arrow-prev"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#FEFEFE" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="icon-arrow-left"><polyline points="15 18 9 12 15 6"></polyline></svg></span>`;
      var selectorNextArrow = `<span class="arrow-slider arrow-next"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#FEFEFE" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="icon-arrow-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>`;

      $($this).slick({
        infinite: false,
        speed: 500,
        cssEase: 'ease',
        swipeToSlide: true,
        vertical: verticalSlide ? true : false,
        verticalSwiping: verticalSlide ? true : false,
        appendDots: selectorAppendDots,
        appendArrows: selectorAppendArrows,
        prevArrow: selectorPrevArrow,
        nextArrow: selectorNextArrow,
        responsive: [
          {
            breakpoint: 768,
            settings: {
              vertical: false,
              verticalSwiping: false,
            }
          }
        ]
      });
    }
  });

  // slideshow
  $('.activate-slider').each(function () {
    var $this = $(this);
    if ($this.children().length > 1) {
      var selectorAppendDots = $this.parent().find('.activate-dots');
      var selectorAppendArrows = $this.parent().find('.activate-arrows');
      var selectorPrevArrow = `<span class="arrow-slider arrow-prev"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="icon-arrow-left"><polyline points="15 18 9 12 15 6"></polyline></svg></span>`;
      var selectorNextArrow = `<span class="arrow-slider arrow-next"><svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="#000" stroke-width="0.5" stroke-linecap="round" stroke-linejoin="round" class="icon-arrow-right"><polyline points="9 18 15 12 9 6"></polyline></svg></span>`;

      function doAnimation() {
        $this.find('.slick-slide').each(function () {
          $(this).find('[data-animation]').each(function () {
            var dataAnimation = $(this).attr('data-animation');
            $(this).removeClass(dataAnimation);

            if ($(this).closest('.slick-slide').is('.slick-current.slick-active')) {
              $(this).addClass(dataAnimation);
            }
          })
        })

        return false;
      }

      $(this)
        .on('init', function (event, slick) {
          doAnimation();
        })
        .on('afterChange', function (event, slick, direction) {
          doAnimation();
        })
        .slick({
          appendDots: selectorAppendDots,
          appendArrows: selectorAppendArrows,
          prevArrow: selectorPrevArrow,
          nextArrow: selectorNextArrow
        });
    }
  })

  // increament-decreament button
  $(".update-qty-btn").on('click', function () {
    var qtyInput = $(this).parent().find('input');

    if ($(this).hasClass('inc-qty')) {

      qtyInput.val(parseInt(qtyInput.val()) + 1);
    } else if (qtyInput.val() > 1) {
      qtyInput.val(parseInt(qtyInput.val()) - 1);
    }
  });

  // footer copyright current date
  $('.current-year').text(new Date().getFullYear());

  // toggle footer menu
  $('.footer-heading').on('click', function () {
    $(this).siblings().slideToggle();
  });

  // toggle & accordion 
  $('.accordion-btn').on('click', function () {
    $(this).siblings('.accordion-child').slideToggle();
    $(this).toggleClass('active');
  });
  $('.write-btn').on('click', function () {
    $(this).closest('.accordion-parent').find('.accordion-child').slideToggle();
  });

  // filter drawer open
  $('.filter-drawer-trigger').on('click', function () {
    $('.filter-drawer').toggleClass('active');
  });

  // product img popup
  $('[data-fancybox="gallery"]').fancybox({
    buttons: [
      "slideShow",
      "thumbs",
      "zoom",
      "fullScreen",
      "share",
      "close"
    ],
    loop: false,
    protect: true
  });


  /* --------------------------------------------------------
    scrollUp active
  -------------------------------------------------------- */
  var scrollUpBtn = $('#scrollup');

  $(window).scroll(function () {
    if ($(window).scrollTop() > 700) {
      scrollUpBtn.addClass('show');
    } else {
      scrollUpBtn.removeClass('show');
    }
  });

  scrollUpBtn.on('click', function (e) {
    e.preventDefault();
    $('html, body').animate({ scrollTop: 0 }, 300);
  });

  /* --------------------------------------------------------
    newsletter popup
  -------------------------------------------------------- */
  $(window).ready(function () {
    setTimeout(function () {
      $('#modal-subscribe').modal("show")
    }, 3000);
  })

})(jQuery);



function addtocartt(event) {
  event.preventDefault()
  let cartForm = document.getElementById('cart-form');
  let formData = new FormData(cartForm)
  formData.append('isset_cart_form', '1');

  $.ajax({
    type: "post",
    url: "ajax.php",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      let data = JSON.parse(response)
      if (data['status']) {
        window.location.href = "cart.php"

      } else {
        alert('already added')
      }
    }
  });
}


function addToCart(event) {
  event.preventDefault()
  let cartForm = document.getElementById('cart-form');
  let formData = new FormData(cartForm)
  formData.append('isset_cart_form', '1');

  $.ajax({
    type: "post",
    url: "ajax.php",
    data: formData,
    contentType: false,
    processData: false,
    success: function (response) {
      let data = JSON.parse(response)
      if (data['status']) {
        $('#add-to-cart-btn').html('<a href="cart.php" class="text-light"><button type="button" name="cart" class="position-relative btn-atc btn-add-to-cart loader">GO TO CART</button></a>')

      } else {
        alert('already added')
      }
    }
  });
}


function drawerCart() {

  $('#cart_container').html('')

  $.ajax({
    type: "post",
    url: "ajax.php",
    data: {
      'isset_drawer_cart_data': 1
    },
    success: function (response) {
      console.log(response)

      let data = JSON.parse(response);

      // console.log(data)

      if (data['product_data']) {

        let product_data = data['product_data'];
        let subtotal = 0;

        if (product_data.length > 0) {
          let i = 1;
          product_data.forEach(element => {
            console.log(element)
            subtotal += (parseFloat(element['price']) * element['qty'])

            $('#cart_container').append(`
            <div class="minicart-item d-flex" >
            <div class="mini-img-wrapper">
                <img class="mini-img" src="admin/upload/${element['img']}" alt="img">
            </div>
            <div class="product-info">
                <h2 class="product-title"><a href="#">${element['name']}</a></h2>
                <div class="misc d-flex align-items-end justify-content-between">
                    <div class="quantity d-flex align-items-center justify-content-between">
                        <button class="qty-btn dec-qty decrease cart-btn" onclick="updateQty('${element['product_id']}','minus','cart_price${i}','cart_qty${i}')"><img src="assets/img/icon/minus.svg" alt="minus"></button>
                        <input class="qty-input item cart-input" type="number" id="cart_qty${i}" name="qty" value="${element['qty']}" min="0">
                        <button class="qty-btn inc-qty increase cart-btn"  onclick="updateQty('${element['product_id']}','plus','cart_price${i}','cart_qty${i}')" ><img src="assets/img/icon/plus.svg" alt="plus"></button>
                    </div>

                    <div class="product-remove-area d-flex flex-column align-items-end">
                        <div class="product-price" id="cart_price${i}" >$ ${element['price'] * element['qty']}</div>
                        
                        <a href="javascript:void(0);" class="product-remove" onclick="remove_product('${element['product_id']}')" >Remove</a>
                    </div>
                </div>
             </div>
            </div>
            `);




            $('#cart-subtotal').html(`$ ${subtotal}`);
            i++

          });

        } else {

          $('#cart_container').html('<h4 class="mx-4 text-dark">Cart Empty</h4>')
        }


      }
    }
  })
};



function remove_product(pro_id) {
  $("#cart-subtotal").html(`0`);
  $.ajax({
    type: "post",
    url: "ajax.php",
    data: { pro_id: pro_id, 'isset_remove_product_from_cart': 1 },
    dataType: "json",
    success: function (response) {

      if (response) {
        drawerCart()
      }
    }
  });
}



function updateQty(product_id, plus_minus, price_box, cart_qty) {


  let cart_qty_value = parseInt($('#' + cart_qty).val())
  if (plus_minus == 'plus') {
    cart_qty_value += 1
  } else {
    if (cart_qty_value > 1) {
      cart_qty_value -= 1
    }
  }

  $('#' + cart_qty).val(cart_qty_value)


  $.ajax({
    type: "post",
    url: "ajax.php",
    data: { pro_id: product_id, update: plus_minus, qty: cart_qty_value, 'isset_update_qty': 1 },
    success: function (response) {
      let data = JSON.parse(response)
      let product_data = JSON.parse(data['product_data'])
      let price = product_data['quantity'] * product_data['price']
      $('#' + price_box).html('$ ' + price)

      let total_price = 0;
      let all_product_data = JSON.parse(data['all_product_data'])
      let keys = Object.keys(all_product_data)
      keys.forEach(single_key => {
        total_price += (all_product_data[single_key]['price'] * all_product_data[single_key]['quantity'])
      });
      $('#cart-subtotal').html('$ ' + total_price)
    }
  });
}



function addshipping(id, name) {
  let value = $('#' + id).val()
  let shipname = $('#' + name).val()

  $.ajax({
    type: "post",
    url: "ajax.php",
    data: { shipping_amount: value, shipping_name: shipname, 'isset_add_shipping': 1 },
    dataType: "json",
    success: function (response) {
      console.log(response)
      // let data = JSON.parse(response)
      // console.log(response['shipping_name'])
      // console.log(response['shipping_price'])

      $('#shipping_amount').html('$' + response['shipping_price'])
      $('#amount_payable').html('$' + response['payable'])
    }
  });
  // console.log(value)
  // console.log(shipname)
}

function selectpayment(value, event) {
  let payment_method = value;

  let src = $(event.target).attr('src')
  sessionStorage.setItem('payment_method', payment_method);
  sessionStorage.setItem('src', src);

  console.log(src)
  $('#payment-option').html(`
  <div>
  <input type='hidden' value='${payment_method}'>
  <img src='${src}' style='width: 100px;'>
  </div>
  `)

}

function pay_now(event) {
  $("#order_btn").html(`<div class="spinner-border spinner-border-sm text-light" role="status">
  <span class="visually-hidden">Loading...</span>
</div>`)
  event.preventDefault();
  src = sessionStorage.getItem('src')
  method = sessionStorage.getItem('payment_method')
  $.ajax({
    type: "post",
    url: "payment_ajax.php",
    data: {
      'isset_order_confirm': 1,
      'payment_method': method,
      'src':src
    },
    success: function (response) {
      // console.log(response);
      let data = JSON.parse(response)
      if(data['status']){
        $("#exampleModal").modal('hide');
        $("#confirmModal").modal('show');
      }
    }
  })
}

function close_confirm_modal(){
  $("#confirmModal").modal('hide');
  window.location.href = "shop.php";
}

function printCard() {

  var bodyContent = document.body.innerHTML;
  var card = document.querySelector('#invoice').innerHTML;

  document.body.innerHTML = card;
  window.print();
  // window.print();
  document.body.innerHTML = bodyContent;
}

function goHome() {
  window.location.href = "shop.php"
}
