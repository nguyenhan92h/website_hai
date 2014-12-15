<?php

class AdminController extends BaseController
{
    /**
     * @return Response
     */
    public function getIndex()
    {
			return View::make('admin.index');
    }

    /**
	 * [changeValueCol description]
	 * @return [type] [description]
	 */
	public function changeValueCol(){
		$url = URL::to('/');
		$input = Input::only('id', 'col', 'tbl', 'val', 'colwhere');
		$icon  = '';
		if($input['val']){
			$input['val'] = 0;
			$icon = '<i class="fa fa-square-o fa-lg"></i>';
		}
		else{
			$input['val'] = 1;
			$icon = '<i class="fa fa-check-square-o fa-lg"></i>';
		}
		$result = Admin::changeCol($input['tbl'], $input['col'], $input['val'], array($input['colwhere'] => $input['id']));
		$html = '';
		if($result){
			$html = '<a href="javascript:void(0)" onclick="changeValueCol('. $input['id'] . ', &#39;' . $input['col'] . '&#39;, ' . '&#39;' . $input['tbl'] . '&#39;, ' . $input['val'] . ', &#39;' . $input['colwhere'] .'&#39;)">';
			$html .= $icon . '</a>';
		}
		echo $html;
	}
}
