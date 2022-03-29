"use strict";

// Class definition
var MVGeneralBlockUI = function() {
    // Private functions
    var example1 = function() {
        var button = document.querySelector("#mv_block_ui_1_button");
        var target = document.querySelector("#mv_block_ui_1_target");

        var blockUI = new MVBlockUI(target);

        button.addEventListener("click", function() {
            if (blockUI.isBlocked()) {
                blockUI.release();
                button.innerText = "Block";
            } else {
                blockUI.block();
                button.innerText = "Release";
            }
        });
    }

    var example2 = function() {
        var button = document.querySelector("#mv_block_ui_2_button");
        var target = document.querySelector("#mv_block_ui_2_target");

        var blockUI = new MVBlockUI(target, {
            message: '<div class="blockui-message"><span class="spinner-border text-primary"></span> Loading...</div>',
        });

        button.addEventListener("click", function() {
            if (blockUI.isBlocked()) {
                blockUI.release();
                button.innerText = "Block";
            } else {
                blockUI.block();
                button.innerText = "Release";
            }
        });
    }

    var example3 = function() {
        var button = document.querySelector("#mv_block_ui_3_button");
        var target = document.querySelector("#mv_block_ui_3_target");

        var blockUI = new MVBlockUI(target, {
            overlayClass: 'bg-danger bg-opacity-25',
        });

        button.addEventListener("click", function() {
            if (blockUI.isBlocked()) {
                blockUI.release();
                button.innerText = "Block";
            } else {
                blockUI.block();
                button.innerText = "Release";
            }
        });
    }

    var example4 = function() {
        var button = document.querySelector("#mv_block_ui_4_button");
        var target = document.querySelector("#mv_block_ui_4_target");

        var blockUI = new MVBlockUI(target);

        button.addEventListener("click", function(e) {
            e.preventDefault();

            blockUI.block();

            setTimeout(function() {
                blockUI.release();
            }, 3000);
        });
    }

    var example5 = function() {
        var button = document.querySelector("#mv_block_ui_5_button");

        var blockUI = new MVBlockUI(document.body);

        button.addEventListener("click", function(e) {
            e.preventDefault();

            blockUI.block();

            setTimeout(function() {
                //blockUI.release();
            }, 3000);
        });
    }

    return {
        // Public Functions
        init: function() {
            example1();
            example2();
            example3();
            example4();
            example5();
        }
    };
}();

// On document ready
MVUtil.onDOMContentLoaded(function() {
    MVGeneralBlockUI.init();
});
