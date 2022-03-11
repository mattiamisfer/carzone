@extends('layouts.app')
@section('title','PERSONAL CAR CARE')
@section('content')



<div id='collection-component-1646663508929'></div>
<script type="text/javascript">
/*<![CDATA[*/
(function () {
  var scriptURL = 'https://sdks.shopifycdn.com/buy-button/latest/buy-button-storefront.min.js';
  if (window.ShopifyBuy) {
    if (window.ShopifyBuy.UI) {
      ShopifyBuyInit();
    } else {
      loadScript();
    }
  } else {
    loadScript();
  }
  function loadScript() {
    var script = document.createElement('script');
    script.async = true;
    script.src = scriptURL;
    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(script);
    script.onload = ShopifyBuyInit;
  }
  function ShopifyBuyInit() {
    var client = ShopifyBuy.buildClient({
      domain: 'carzoneae.myshopify.com',
      storefrontAccessToken: 'f70daff8fe02b9e2d3f0396e4656c8d3',
    });
    ShopifyBuy.UI.onReady(client).then(function (ui) {
      ui.createComponent('collection', {
        id: '268499484804',
        node: document.getElementById('collection-component-1646663508929'),
        moneyFormat: 'Dhs.%20%7B%7Bamount%7D%7D',
        options: {
  "product": {
    "styles": {
      "product": {
        "@media (min-width: 601px)": {
          "max-width": "calc(25% - 20px)",
          "margin-left": "20px",
          "margin-bottom": "50px",
          "width": "calc(25% - 20px)"
        },
        "img": {
          "height": "calc(100% - 15px)",
          "position": "absolute",
          "left": "0",
          "right": "0",
          "top": "0"
        },
        "imgWrapper": {
          "padding-top": "calc(75% + 15px)",
          "position": "relative",
          "height": "0"
        }
      },
      "button": {
        ":hover": {
          "background-color": "#ff0031"
        },
        "background-color": "#d8001d",
        ":focus": {
          "background-color": "#ff0031"
        },
        "border-radius": "0px"
      }
    },
    "buttonDestination": "checkout",
    "text": {
      "button": "Buy now"
    }
  },
  "productSet": {
    "styles": {
      "products": {
        "@media (min-width: 601px)": {
          "margin-left": "-20px"
        }
      }
    }
  },
  "modalProduct": {
    "contents": {
      "img": false,
      "imgWithCarousel": true,
      "button": false,
      "buttonWithQuantity": true
    },
    "styles": {
      "product": {
        "@media (min-width: 601px)": {
          "max-width": "100%",
          "margin-left": "0px",
          "margin-bottom": "0px"
        }
      },
      "button": {
        ":hover": {
          "background-color": "#ff0031"
        },
        "background-color": "#d8001d",
        ":focus": {
          "background-color": "#ff0031"
        },
        "border-radius": "0px"
      }
    },
    "text": {
      "button": "Add to cart"
    }
  },
  "option": {},
  "cart": {
    "styles": {
      "button": {
        ":hover": {
          "background-color": "#ff0031"
        },
        "background-color": "#d8001d",
        ":focus": {
          "background-color": "#ff0031"
        },
        "border-radius": "0px"
      }
    },
    "text": {
      "total": "Subtotal",
      "button": "Checkout"
    }
  },
  "toggle": {
    "styles": {
      "toggle": {
        "background-color": "#d8001d",
        ":hover": {
          "background-color": "#ff0031"
        },
        ":focus": {
          "background-color": "#ff0031"
        }
      }
    }
  }
},
      });
    });
  }
})();
/*]]>*/
</script>
@endsection