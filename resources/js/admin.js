import $ from 'jquery';

$(function () {
  const wrapper = $('#custom_options_product_data .group_wrapper');
  if (!wrapper.length) {
    return;
  }

  const title = wrapper.find('.group_wrapper_title');
  const content = wrapper.find('.collapsible-content');

  content.hide();
  wrapper.addClass('closed');

  title.on('click', function () {
    content.slideToggle(200);
    wrapper.toggleClass('closed');
  });
});