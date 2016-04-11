$('.payout-label input').change(function() {
    $('.payout-icon').addClass('overlay').removeClass('halo');
    $(this).siblings('.payout-icon').removeClass('overlay').addClass('halo');
})

// darken character icons
$('.character-label input').change(function() {
    $('.character-icon').addClass('overlay').removeClass('halo');
    $(this).siblings('.character-icon').removeClass('overlay').addClass('halo');
});
