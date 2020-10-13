$(document).ready(function () {
        $('.ratings_stars').hover(
            // Handles the mouseover

            function () {
                $(this).prevAll().andSelf().addClass('ratings_hover');

                //$(this).nextAll().removeClass('ratings_vote'); 
            },
            function () {
                $(this).prevAll().andSelf().removeClass('ratings_hover');
                // set_votes($(this).parent());
            }
        );

        $('.ratings_stars').click(function () {
            var rate_blog = $(this).find("input").val();
            var user_id = document.getElementById('user_id').value;
            var blog_id = document.getElementById('blog_id').value;
            var url = '/blog/rate';
            $.ajax({
                url: url,
                type: 'get',
                dataType: 'json',
                data: { 'rate_blog': rate_blog, 'user_id': user_id, 'blog_id': blog_id },
                success: function (data) {
                }
            });
            alert("Thank You rate blog");
            if ($(this).hasClass('ratings_over')) {
                $('.ratings_stars').removeClass('ratings_over');
                $(this).prevAll().andSelf().addClass('ratings_over');
            } else {
                $(this).prevAll().andSelf().addClass('ratings_over');
            }
        });
});