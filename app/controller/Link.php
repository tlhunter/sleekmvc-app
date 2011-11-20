<?php
namespace App;

class Controller_Link extends \Sleek\Controller_Base {

    /**
     * This function is run when someone visits /link/abcDEF123
     * @return void
     */
    public function noAction() {
        $id = Model_EzLink::codeToInteger($this->request->urlAction());
        $hidden = $this->request->get('h') !== NULL;

        $EzLink = new Model_EzLink();
        $url = $EzLink->getUrlById($id);
        $EzLink->clickUrl($id, date("Y"), date("n"));
        
        if ($hidden) {
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=$url\">";
        } else {
            $this->response->redirect($url);
        }
    }
}
