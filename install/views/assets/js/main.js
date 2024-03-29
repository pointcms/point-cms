$(function(){
    $('select').selectpicker();


    // Toggle the password field type
    $('.show-hide-password').click(function() {
        var field = $('.db-password-field').get(0);
        field.type = toggleData(field.type, ['text', 'password']);
    });

    /**
     * Given an array and a value, toggle the data between the two
     * values
     *
     * @param Dynamic value
     * @param Array choice
     */
    function toggleData(value, choice) {
        if(choice.length < 2 || choice == 'undefined' || value == 'undefined')
            return false;

        return (value == choice[0] ? choice[1] : choice[0]);
    }
});
