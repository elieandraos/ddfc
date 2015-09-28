<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Page;
use Gaia\Repositories\PostRepositoryInterface;
use Gaia\Repositories\PostTypeRepositoryInterface;

use App\Models\Section;
use App\Models\ComponentPost;
use App\Models\Post;
use App\Models\Subscriber;
use App\Models\Country;
use MediaLibrary;
use MetaTag;
use Redirect;
use Mail;
use Hash;
use Input;
use App;


class PageController extends Controller {

	
	public function __construct(PostRepositoryInterface $postRepositoryInterface, PostTypeRepositoryInterface $postTypeRepositoryInterface)
	{
		$this->postRepos     = $postRepositoryInterface;
		$this->postTypeRepos = $postTypeRepositoryInterface;
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show(Page $page)
	{
		
		MetaTag::setTitle($page->seo->meta_title);
        MetaTag::setDescription($page->seo->meta_description);
        MetaTag::setKeywords($page->seo->meta_keywords);
        MetaTag::setFacebookTags([
         	'title' => $page->seo->facebook_title, 
         	'description' => $page->seo->facebook_description, 
         	'image' => '', 
         	'url' => route('pages.show', $page->slug) 
         ]);
        MetaTag::setTwitterDescription($page->seo->twitter_description);

		//get metas 
		$metas = [];
		foreach($page->componentPages as $componentPage)
		{
			$key = $componentPage->component->unique_id;
			if($componentPage->component->component_type_id == 3) //image
			{
				$mediaItems = MediaLibrary::getCollection($componentPage, $componentPage->getMediaCollectionName(), []);
				(count($mediaItems))?$url = $mediaItems[0]->getURL():$url = null;
				$metas[$key] = $url;
			}	 
			else
				$metas[$key] = $componentPage->value;
		}

		//get members (special case for higher committee)
		$members = $this->postRepos->getAllByPostTypeSlug('members');
		//get the top member
		$postType = $this->postTypeRepos->getBySlug('members');
		$section = $postType->template->sections->first();
		$component = $section->components()->where('unique_id', '=', 'is_highlighted')->first();
		$cp = ComponentPost::where('component_id', '=', $component->id)->first();
		$top_member = Post::find($cp->post_id); 

		return view('front.pages.'.$page->template->title, ['page' => $page, 'content' => $metas, 'members' => $members, 'top_member' => $top_member ]);
	}


	public function contact(Request $request)
	{
		$this->validate($request, [
	        'subject' => 'required',
	        'message' => 'required',
	        'email' => 'required|email'
	    ]);

		$data['email'] = $request->email;
		$data['message'] = $request->message;
		$data['subject'] = $request->subject;
		$data['phone'] = $request->phone;

		Mail::send('emails.contact', ['data' => $data],  function($m) use ($data) {
		    $m->from($data['email'], 'DDFC Contact');
		    $m->to('info@communitydubai.com');
		    $m->subject($data['subject']);
		});

		return redirect('page/contact-us?success=1');
	}


	public function forum(Request $request)
	{
		$this->validate($request, [
	        'first_name' => 'required',
	        'last_name' => 'required',
	        //'address' => 'required',
	        'phone' => 'required',
	        'title' => 'required',
	        'email' => 'required|email|unique:subscribers'
	    ]);

		$data = Input::all();
		$data['is_verified'] = 0;
		$data['verification_token'] = uniqid();

		Subscriber::create($data);
		
		$data['ticket_id'] = $data['verification_token'];

		Mail::send('emails.rsvp', ['data' => $data],  function($m) use ($data) {
		    $m->from('info@mycommunitydubai.com', 'My Community Dubai');
		    $m->to($data['email']);
		    $m->subject("Dubai Inclusive Development Forum Confirmation of Registration");
		});
		

		Mail::send('emails.rsvp_admin', ['data' => $data],  function($m) use ($data) {
		    $m->from('info@mycommunitydubai.com', 'My Community Dubai');
		    $m->to('info@mycommunitydubai.com');
		    $m->subject("RSVP");
		});

		return redirect('rsvp?success=1');
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function rsvp()
	{
		
		$page = Page::where('slug', "=", "rsvp")->first();
		$countries = Country::all()->lists('full_name', 'id');
		$titles = [ 
			"Mr." => "Mr.", 
			"Mrs." => "Mrs.",  
			"Ms." => "Ms.", 
			"Dr." => "Dr.", 
			"Eng." => "Eng."
		];

		$titles_ar = [ 
			"السيد" => "السيد", 
			"السيدة" => "السيدة", 
			"الآنسة" => "الآنسة", 
			"الدكتور" => "الدكتور", 
			"المهندس" => "المهندس"
		];


		$fields = [ 
			"Communication" => "Communication", 
			"Health" => "Health", 
			"Tourism" => "Tourism"
		];

		$fields_ar = [ 
			"الاتصالات" => "الاتصالات", 
			"الصحة" => "الصحة", 
			"سياحة" => "سياحة"
		];

		$agenda = [
			'day1' =>
				[

					[
						'time' => '08:00- 09:30',
						'activity' =>'Registration',
						'speakers' => 'Live Art by PWD',
						'description' => ''
					],
					[
						'time' => '09:30-10:00',
						'activity' =>'Introduction',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '10:00-10:30',
						'activity' =>'Official Opening',
						'speakers' => '<span class="heading11">Under the Patronage of H.H. Sh. Mansour Bin Mohammed Bin Rashid Al Maktoum.</span>',
						'description' => ''
					],
					[
						'time' => '10:30- 11:00',
						'activity' =>'Keynote 1:',
						'speakers' => '<span class="heading11">Ms. Charlotte McClain-Nhlapo</span>, Global Disability Advisor- World Bank Group, USA',
						'description' => 'Inclusive Planning & Policy Development: Translating the UNCRPD into National & Local Strategies'
					],
					[
						'time' => '11:00- 11:30',
						'activity' =>'Keynote 2:',
						'speakers' => '<span class="heading11">Mr. Victor Calise</span>, Commissioner- New York City Mayor’s Office for People with Disabilities, USA',
						'description' => 'Achieving Inclusion in a Global Mega-City: The  Case of New York City'
					],
					[
						'time' => '11:30- 12:00',
						'activity' =>'Keynote 3:',
						'speakers' => '<span class="heading11">Dr. Ivor Ambrose</span>, Managing Director ENAT - European Network for Accessible Tourism, Greece',
						'description' => 'Accessible Tourism: a Driver of Inclusive Destination Development'
					],
					[
						'time' => '12:00- 13:00',
						'activity' =>'Lunch',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '13:00- 14:30',
						'activity' =>'Panel Discussion 1:',
						'speakers' => '',
						'description' => 'Developmental Screening and Early Intervention <br/> <span class="heading11">Panel Discussion 2:</span> Inclusive Urban Development <br/> <span class="heading11">Panel Discussion 3:</span> Inclusive Employment & Entrepreneurship'
					],
					[
						'time' => '14:30-14:45',
						'activity' =>'Coffee Break',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '14:45- 16:15',
						'activity' =>'Panel Discussion 4:',
						'speakers' => '',
						'description' => 'Inclusive Education & Learning <br/> <span class="heading11">Panel Discussion 5:</span> Hospitality, Leisure & Tourism<br/> <span class="heading11">Panel discussion 6:</span> Social Protection'
					],
				],
			'day2' =>
				[

					[
						'time' => '09:00-09:15',
						'activity' =>'Keynote 1:',
						'speakers' => '<span class="heading11">Mrs. Aisha A. Miran</span>, Assistant Secretary General- Strategy Management Sector- The General Secretariat of the Executive Council of Dubai, UAE',
						'description' => 'My Community: Dubai’s Journey Towards Full Inclusion by the Year 2020'
					],
					[
						'time' => '09:15-9:45',
						'activity' =>'Keynote 2:',
						'speakers' => '<span class="heading11">Dr. Peyvand Khaleghian</span>, Managing Partner- Avicenna Partners, UAE',
						'description' => 'Innovations in Inclusive Development for People with Complex Medical Needs'
					],
					[
						'time' => '9:45-10:00',
						'activity' =>'Coffee Break',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '10:00- 12:00',
						'activity' =>'Barrier Analysis & Recommendations',
						'speakers' => '<br/><br/><br/><span class="heading11">Facilitator: Dr. Michael Gamal-McCormack</span>, <br/>Associate Executive Director for Research and Policy, Association of University Centers on Disabilities (AUCD), USA<br/><br/> <span class="heading11">Facilitator: Dr. Bill Sarnecky</span>,<br/>Associate Professor of Architecture at American University of Sharjah, UAE<br/><br/> <span class="heading11">Facilitator: Dr. Maha Damaj</span>,<br/>Assistant Professor of Public Health Practice, American University of Beirut, Lebanon',
						'description' => 'UNCRPD Translated into Specific Policies and Programs.<br/><br/><span class="heading11">1- Developmental Screening and Early Intervention  <br/><br/> 2- Inclusive Urban Development <br/><br/>3- Social Protection</span>'
					],
					[
						'time' => '12:00- 13:00',
						'activity' =>'Lunch',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '13:00- 15:00',
						'activity' =>'Barrier Analysis & Recommendations:',
						'speakers' => '<br/><br/><br/><span class="heading11">Facilitator:  Dr. Paula Hunt</span>,<br/>Senior Expert on Inclusive Education and Disability, DED - Disability, Education and Development, Lda., Portugal<br/><br/> <span class="heading11">Facilitators:  Dr. William Kiernan</span>,<br/>Dean, School for Global Inclusion and Social Development at University of Massachusetts Boston & Director Of ICI, USA<br/><br/><span class="heading11">Facilitator: Dr. Ivor Ambrose</span>,<br/>Managing Director, ENAT - European Network for Accessible Tourism, Greece',
						'description' => 'UNCRPD Translated into Specific Policies and Programs.<br/><br/><span class="heading11"> 4-	Inclusive Education<br/><br/> 5-	Inclusive Employment & Entrepreneurship<br/><br/> 6-	Inclusive Tourism, Leisure and Hospitality </span> '
					],
					[
						'time' => '15:00- 16:00',
						'activity' =>'Concluding Remarks',
						'speakers' => '',
						'description' => ''
					],
				]
		];

		$agenda_ar = [
			'day1' =>
				[

					[
						'time' => '8:00 - 9:30 صباحاً',
						'activity' =>'التسجيل',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '9:30 - 10:00 صباحاً',
						'activity' =>'المقدمة',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '10:00 - 10:30 صباحاً',
						'activity' =>'الكلمة الافتتاحيّة',
						'speakers' => '<span class="heading11">تحت رعاية سمو الشيخ منصور بن محمد بن راشد آل مكتوم</span>',
						'description' => ''
					],
					[
						'time' => '10:30 - 11:00 صباحاً',
						'activity' =>'الكلمة الرئيسيّة الأولى:',
						'speakers' => 'السيدة شارلوت ماكلين- نهلابو، المستشارة العالمية لشؤون الإعاقة - مجموعة البنك الدولي',
						'description' => 'التخطيط وسياسات التنمية الدامجة:
 ترجمة الاتفاقية الدولية لحقوق الأشخاص ذوي الإعاقة إلى استراتيجيات وطنيّة ومحلية
'
					],
					[
						'time' => '11:00 - 11:30 صباحاً',
						'activity' =>'الكلمة الرئيسيّة الثانية:',
						'speakers' => 'السيد فيكتور كالايس، مفوض - مكتب عمدة مدينة نيويورك لشؤون الأشخاص ذوي الإعاقة ',
						'description' => 'تحقيق التنمية الدامجة في المدن العالمية الكبرى:
مدينة نيويورك نموذجاً
'
					],
					[
						'time' => '11:30 - 12:00 ظهراً',
						'activity' =>'الكلمة الرئيسيّة الثالثة:',
						'speakers' => 'الدكتور آيفور أمبروس، مدير تنفيذي - الشبكة الأوروبية للسياحة الدامجة (ENAT)',
						'description' => 'السياحة الدامجة'
					],
					[
						'time' => '12:00 - 1:00 ظهراً',
						'activity' =>'غداء',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '1:00 - 2:30 ظهراً',
						'activity' =>'الجلسة الحوارية الأولى:',
						'speakers' => '',
						'description' => 'الكشف والتدخل المبكر<br><span class="heading11">الجلسة الحوارية الثانية:</span> التنمية العمرانية الدامجة<br><span class="heading11">الجلسة الحوارية الثالثة: </span>التوظيف الدامج وتأسيس الأعمال'
					],
					[
						'time' => '2:30 -  2:45 ظهراً',
						'activity' =>'استراحة',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '2:45 - 4:15 عصراً',
						'activity' =>'الجلسة الحوارية الرابعة:',
						'speakers' => '',
						'description' => 'التعليم الدامج <br/> <span class="heading11">الجلسة الحوارية الخامسة: </span> السياحة والضيافة والترفيه الدامج<br/> <span class="heading11">الجلسة الحوارية السادسة:</span> الحماية الاجتماعية'
					],
				],
			'day2' =>
				[

					[
						'time' => '9:00 - 9:15 صباحاً',
						'activity' =>'الكلمة الرئيسة الأولى:',
						'speakers' => 'السيدة عائشة ميران، مساعد الأمين العام - قطاع الإدارة الاستراتيجية والحوكمة - الأمانة العامة للمجلس التنفيذي لإمارة دبي',
						'description' => 'مجتمعي: مسيرة دبي نحو مدينة دامجة وصديقة للأشخاص ذوي الإعاقة بحلول العام 2020'
					],
					[
						'time' => '9:15 - 9:45 صباحاً',
						'activity' =>'الكلمة الرئيسة الثانية:',
						'speakers' => 'الدكتور بيفاند خاليغان، الشريك الإداري - شركة افيسينا',
						'description' => 'ابتكارات في التخطيط الدامج للأشخاص ذوي الاحتياجات الطبيّة المعقدة'
					],
					[
						'time' => '9:45 - 10:00 صباحاً',
						'activity' =>'استراحة',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '10:00 - 12:00 ظهراً',
						'activity' =>'مناقشة وتحليل العقبات والتوصيات:',
						'speakers' => '<br/><br/><br/><span class="heading11">مدير الجلسة: الدكتور مايكل ماكورماك</span><br/><br/> <span class="heading11">مدير الجلسة: البروفيسور بيل سارنكي </span> <br/><br/> <span class="heading11">مدير الجلسة: الدكتورة مها دماج</span>',
						'description' => 'ترجمة الاتفاقية الدولية لحقوق الأشخاص ذوي الإعاقة إلى سياسات وبرامج محددة<br/><br/><span class="heading11">1. الكشف والتدخل المبكر<br/><br/> 2- التنمية العمرانية الدامجة <br/><br/>3- الحماية الاجتماعية</span>'
					],
					[
						'time' => '12:00 - 1:00 ظهراً',
						'activity' =>'الغداء',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '1:00 - 3:00 ظهراً',
						'activity' =>'مناقشة وتحليل العقبات والتوصيات:',
						'speakers' => '<br/><br/><br/><span class="heading11">مدير الجلسة: الدكتورة بولا هانت</span><br/><br/> <span class="heading11">مدير الجلسة: الدكتور وليام كيرنان</span><br/><br/><span class="heading11">مدير الجلسة: الدكتور ايفور أمبروس</span>',
						'description' => 'تحويل اتفاقية حقوق الأشخاص ذوي الإعاقة إلى سياسات وبرامج محددة<br/><br/><span class="heading11">4- التعليم الدامج<br/><br/>5- التوظيف الدامج وتأسيس الأعمال<br/><br/>6.	السياحة والضيافة والترفيه الدامج</span> '
					],
					[
						'time' => '3:00 - 4:00 عصراً',
						'activity' =>'الكلمة الختامية',
						'speakers' => '',
						'description' => ''
					],
				]
		];

		MetaTag::setTitle($page->seo->meta_title);
        MetaTag::setDescription($page->seo->meta_description);
        MetaTag::setKeywords($page->seo->meta_keywords);
        MetaTag::setFacebookTags([
         	'title' => $page->seo->facebook_title, 
         	'description' => $page->seo->facebook_description, 
         	'image' => '', 
         	'url' => route('pages.show', $page->slug) 
         ]);
        MetaTag::setTwitterDescription($page->seo->twitter_description);

		//get metas 
		$metas = [];
		foreach($page->componentPages as $componentPage)
		{
			$key = $componentPage->component->unique_id;
			if($componentPage->component->component_type_id == 3) //image
			{
				$mediaItems = MediaLibrary::getCollection($componentPage, $componentPage->getMediaCollectionName(), []);
				(count($mediaItems))?$url = $mediaItems[0]->getURL():$url = null;
				$metas[$key] = $url;
			}	 
			else
				$metas[$key] = $componentPage->value;
		}

	
		if(App::getLocale() == "ar")
			return view('front.pages.'.$page->template->title, ['page' => $page, 'content' => $metas, 'countries' => $countries, "titles" => $titles_ar, 'fields' => $fields_ar, 'agenda'=>$agenda_ar]);
		else
			return view('front.pages.'.$page->template->title, ['page' => $page, 'content' => $metas, 'countries' => $countries, "titles" => $titles, 'fields' => $fields, 'agenda'=>$agenda]);

	}

}
