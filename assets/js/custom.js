$(".title_01").click(function (e) {
    e.preventDefault();
    $(".slide_01").removeClass('hidden');
    $(".slide_02").addClass('hidden');
    $(".slide_03").addClass('hidden');
    $(".slide_04").addClass('hidden');
    $(".slide_05").addClass('hidden');
    $(".slide_default").addClass('hidden');
})

$(".title_02").click(function (e) {
    e.preventDefault();
    $(".slide_02").removeClass('hidden');
    $(".slide_01").addClass('hidden');
    $(".slide_03").addClass('hidden');
    $(".slide_04").addClass('hidden');
    $(".slide_05").addClass('hidden');
    $(".slide_default").addClass('hidden');
})

$(".title_03").click(function (e) {
    e.preventDefault();
    $(".slide_03").removeClass('hidden');
    $(".slide_01").addClass('hidden');
    $(".slide_02").addClass('hidden');
    $(".slide_04").addClass('hidden');
    $(".slide_05").addClass('hidden');
    $(".slide_default").addClass('hidden');
})

$(".title_04").click(function (e) {
    e.preventDefault();
    $(".slide_04").removeClass('hidden');
    $(".slide_01").addClass('hidden');
    $(".slide_02").addClass('hidden');
    $(".slide_03").addClass('hidden');
    $(".slide_05").addClass('hidden');
    $(".slide_default").addClass('hidden');
})

$(".title_05").click(function (e) {
    e.preventDefault();
    $(".slide_05").removeClass('hidden');
    $(".slide_01").addClass('hidden');
    $(".slide_02").addClass('hidden');
    $(".slide_03").addClass('hidden');
    $(".slide_04").addClass('hidden');
    $(".slide_default").addClass('hidden');
});



