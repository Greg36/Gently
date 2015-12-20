/**
 * navigation.js
 *
 * Handles toggling the navigation menu for small screens and enables tab
 * support for dropdown menus.
 */
(function ($) {

    // Search toggle
    $('.search-toggle').bind('touchstart click', ( function () {
        $(this).parent().toggleClass('search-open');

        if ($(this).parent().hasClass('search-open')) {
            $(this).attr( 'aria-expanded', 'true' );
            $(this).next().children().attr( 'aria-expanded', 'true' );
        } else {
            $(this).attr( 'aria-expanded', 'false' );
            $(this).next().children().attr( 'aria-expanded', 'false' );
        }
    }));

    var container, button, menu, links, subMenus;

    container = $('#site-navigation')[0];
    if (!container) {
        return;
    }

    button = $('.top-bar .menu-toggle')[0];
    if ('undefined' === typeof button) {
        return;
    }

    menu = $('#primary-menu')[0];
    // Hide menu toggle button if menu is empty and return early.
    if ('undefined' === typeof menu) {
        button.style.display = 'none';
        return;
    }

    menu.setAttribute('aria-expanded', 'false');
    if (-1 === menu.className.indexOf('nav-menu')) {
        menu.className += ' nav-menu';
    }

    button.onclick = function () {
        if (-1 !== container.className.indexOf('toggled')) {
            container.className = container.className.replace(' toggled', '');
            button.setAttribute('aria-expanded', 'false');
            menu.setAttribute('aria-expanded', 'false');
            $('#site-navigation').slideUp();
        } else {
            container.className += ' toggled';
            button.setAttribute('aria-expanded', 'true');
            menu.setAttribute('aria-expanded', 'true');
            $('#site-navigation').slideDown();
        }
    };

    // Get all the link elements within the menu.
    links = menu.getElementsByTagName('a');
    subMenus = menu.getElementsByTagName('ul');

    // Set menu items with submenus to aria-haspopup="true".
    for (var i = 0, len = subMenus.length; i < len; i++) {
        subMenus[i].parentNode.setAttribute('aria-haspopup', 'true');
    }

    // Sub menu toggle on click or enter press
    var flag = false;
    var $subMenu = $('.nav-sub-icon');
    $subMenu.next().hide();
    $subMenu.bind('click keydown', function (e) {
        if (e.type === "keydown" && e.which !== 13 ){
            return;
        }
        if (!flag) {
            if(-1 !== this.className.indexOf('arrow-active')) {
                this.setAttribute('aria-expanded', 'false');
            } else {
                this.setAttribute('aria-expanded', 'true');
            }
            flag = true;
            setTimeout(function () {
                flag = false;
            }, 100);
            $(this).next().slideToggle(400);
            $(this).toggleClass('arrow-active');
        }
    });

    // Toggle `focus` class to allow submenu access on tablets.
    $( '.nav-menu > li.menu-item-has-children' ).on("touchstart", function (e) {
        var link = $(this);
        if (link.hasClass('focus')) {
            return true;
        }
        else {
            link.addClass('focus');
            $('.nav-menu > li').not(this).removeClass('hover');
            e.preventDefault();
            return false;
        }
    });

    // Each time a menu link is focused or blurred, toggle focus.
    for (i = 0, len = links.length; i < len; i++) {
        links[i].addEventListener('focus', toggleFocus, true);
        links[i].addEventListener('blur', toggleFocus, true);
    }


    /**
     * Sets or removes .focus class on an element.
     */
    function toggleFocus() {
        var eleFocus = this;

        // Move up through the ancestors of the current link until we hit .nav-menu.
        while (-1 === eleFocus.className.indexOf('nav-menu')) {

            // On li elements toggle the class .focus.
            if ('li' === eleFocus.tagName.toLowerCase()) {
                if (-1 !== eleFocus.className.indexOf('focus')) {
                    eleFocus.className = eleFocus.className.replace(' focus', '');
                } else {
                    eleFocus.className += ' focus';
                }
            }

            eleFocus = eleFocus.parentElement;
        }
    }
})(jQuery);
