<?php

namespace Application\Controller {

class Index extends Generic {

    public function IndexAction ( ) {

        $this->view->addOverlay('hoa://Application/View/Index.xyl');
        $this->render();

        return;
    }

    public function FeaturesAction ( ) {

        $this->view->addOverlay('hoa://Application/View/Features.xyl');
        $this->render();

        return;
    }

    public function SourceAction ( ) {

        $this->view->addOverlay('hoa://Application/View/Source.xyl');
        $this->render();

        return;
    }

    public function CommunityAction ( ) {

        $this->view->addOverlay('hoa://Application/View/Community.xyl');
        $this->render();

        return;
    }

    public function AboutAction ( ) {

        $this->view->addOverlay('hoa://Application/View/About.xyl');
        $this->render();

        return;
    }
}

}
