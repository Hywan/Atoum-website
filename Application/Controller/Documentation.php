<?php

namespace Application\Controller {

class Documentation extends Generic {

    public function IndexAction ( ) {

        $this->view->addOverlay('hoa://Application/View/Documentation/Index.xyl');
        $this->render();

        return;
    }
}

}
