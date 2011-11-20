<?php
namespace App;

class Controller_Statistics extends Controller_HasLayout {
    /**
     * This is the page when the user visits /statistics
     * @return void
     */
    public function action_index() {
        $this->page_data['content'] = \Sleek\View::render('pages/statistics', $this->page_data, TRUE);
    }

    /**
     * This is an interesting method. It returns an image, not HTML!
     * @return void
     */
    public function action_image() {
        $this->auto_render_layout = FALSE;
        $EzLink = new Model_EzLink();
        $image = $EzLink->getStatisticsImage();

        $this->response->header('Content-type', 'image/png');
        imagepng($image);
    }
}
