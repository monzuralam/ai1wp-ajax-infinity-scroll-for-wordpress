jQuery(document).ready(function($){
    let canbeLoaded = true;
    const bottomOffset = 1000;

    $(window).scroll(function(){
        if( $(document).scrollTop() > ( $(document).height() - bottomOffset ) && canbeLoaded == true ){
            $.ajax({
                url: aaisfw_data.ajaxurl,
                data: {
                    'action': 'infinity_scroll',
                    'query' : aaisfw_data.posts,
                    'page'  : aaisfw_data.current_page,
                },
                type: 'POST',
                beforeSend: function(){
                    $('.aaisfw_loadmore').html('Loading...');
                    canbeLoaded = false;
                },
                success: function(response){
                    if( response ){
                        $('.aaisfw_wrapper').append(response);
                        canbeLoaded = true;
                        aaisfw_data.current_page++;
                        $('.aaisfw_loadmore').html('Load More');
                    }else{
                        $('.aaisfw_loadmore').html('No more posts found');
                    }
                },
                error: function(error){
                    console.log('error');
                }
            });
        }
    });
});