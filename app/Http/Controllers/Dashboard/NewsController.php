<?php namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\NewsFormRequest;
use App\News;
use App\Picture;
use App\Tag;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\File;
use DateTime;


class NewsController extends Controller {

	public function __construct(){
	}

	/**
	 * @return $this
	 */
	public function index(){
		$page_name = "Notícias e eventos";
		return view('dashboard.news.index')
			->with('page_name',$page_name)
			->with('allNews',News::with('pictures')
					->with('tags')
					->paginate(6));
	}

	/**
	 * @return $this
	 */
	public function add()
	{
		$page_name = "Nova Notícia";
		return view('dashboard.news.new')
			->with('page_name',$page_name);
	}

	/**
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function post_add(NewsFormRequest $request)
	{
		$news = News::create($request->all());

		$tags = array_filter(array_map('trim',explode(',',$request->get('tags'))));

		foreach($tags as $tag) {
			if (Tag::where('name', '=', $tag)->first() == null){
				$newTag = Tag::create(['name'=>$tag]);
				$news->tags()->attach($newTag);
			}else{
				$tagId = Tag::where('name','=',$tag)->first()->id;
				$news->tags()->attach($tagId);
			}
		}


		// Save Images
		if(array_shift($request->file('images')) != null){
			foreach($request->file('images') as $image){
				$imageName = uniqid().'.'.$image->getClientOriginalExtension();
				$imagePath = $image->move('img/news/'.$news->id.'/', $imageName);

				$picture = new Picture();
				$picture->path = $imagePath;
				$picture->ext = $image->getClientOriginalExtension();
				$picture->news_id = $news->id;

				$picture->save();
			}
		}

		Flash::success('Notícia cadastrada!');
		return redirect(route('news.index'));
	}

	/**
	 * @param $id
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function delete($id)
	{
		$news = News::find($id);
		$deleteDir = File::deleteDirectory((base_path().'/public/'.'img/news/'.$news->id));
		$news->delete();
		Flash::success('Notícia deletada!');
		return redirect(route('news.index'));
	}

	/**
	 * @param $id
	 * @return $this
	 */
	public function edit($id)
	{
		$news = News::find($id);
		$page_name = "Editar notícia";
		return view('dashboard.news.edit')
			->with('page_name',$page_name)
			->with('edit_news',$news)
			->with('images',File::files('img/news/'.$news->id));
	}

	/**
	 * @param Request $request
	 * @return $this|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
	public function post_edit(NewsFormRequest $request, $id)
	{

		dd('oi');
		//Modify request timestamp format for db
		$date = $request->expired.':00';
		$expired = Carbon::createFromFormat('d/m/Y H:i:s',$date);
		$request->merge(array('expired' => $expired->format('Y-m-d H:i:s')));

		//Save on BD
		$news = News::find($id);
		$news->fill($request->all());
		if(!empty($request->file('image'))){
			File::delete(base_path().'/public/img/news/'.$id.'.'.$news->img_ext);

			$news->img_ext = $request->file('image')->getClientOriginalExtension();
			//Save News image
			$imageName = $news->id . '.' .
				$request->file('image')->getClientOriginalExtension();
			$request->file('image')->move(
				base_path() . '/public/img/newss/', $imageName
			);
		}
		$news->save();

		Flash::success('Oferta atualizada!');
		return redirect(route('news.index'));
	}
	
}