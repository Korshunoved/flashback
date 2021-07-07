let HttpRequest = {
    searchQuery: function (request, handler) {
        return this.post(
            request,
            function (response) {
                return CryptotikAjaxSearch[handler](response);
            });
    },
    post:function (request, success) {
        return $.ajax({
            url: cryptotikAjax.url,
            method: 'POST',
            data: {
                action: 'cryptotik_ajax_search',
                queryString: request,
            },
            success:success,
            error:function (error) {
                console.log(error);
            },
        });
    }
};

let CryptotikAjaxSearch = {
    response: {},
    init: function () {
        this.suggestionBlock = jQuery('#search-suggestion__js');
    },
    inputField: function (e) {
        let _this = this;

        $.when(HttpRequest.searchQuery(e.target.value, 'responseHandler'))
            .then(function() {
                _this.render();
            });

        return true;
    },
    responseHandler: function (response) {
        this.response = JSON.parse(response);
    },
    render: function () {
        let suggestionBlock = jQuery('#search-suggestion__js');
        jQuery('.form-search').addClass('active')

        suggestionBlock.show();
        suggestionBlock.html(this.getList());

        if(this.getList().length == 0){
            jQuery('.form-search').removeClass('active')
        }
    },
    getList: function () {
        console.log(this.response);
        let text = '';
        for (let groupName in this.response) {
            let group = this.response[groupName];
            console.log(group);
            console.log(group.length);
            if (group.length > 0) {
                text += '<div class="search-suggestion__block">' +
                            '<div class="search-suggestion__title">' + groupName + '</div>' +
                            '<div class="search-suggestion__list">';
                for (let item in group) {
                    text += '<div class="search-suggestion__item"><a href="'
                        + group[item].href + '" alt="">' + group[item].name + '</a></div>';
                }
                text += '</div></div>';
            }
        }
        return text;
    }
};

jQuery(document).ready(function($) {
    function IsJsonString_cryptotik(str) {
        try {
            JSON.parse(str);
        } catch (e) {
            return false;
        }
        return true;
    }

    CryptotikAjaxSearch.init();

    document.getElementsByClassName('search-input-placeholder-js')[0]
        .addEventListener('keyup', function (e) {
            CryptotikAjaxSearch.inputField(e);
        });

    jQuery('.search-input-placeholder-js').on('blur', function () {
        setTimeout(function () {
            jQuery('#search-suggestion__js').hide();
        }, 500);
    });
});