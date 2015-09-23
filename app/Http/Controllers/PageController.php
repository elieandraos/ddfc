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
						'speakers' => '',
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
						'speakers' => 'Under the Patronage of H.H. Sheikh Mansoor Bin Mohammed Bin Rashid Al Maktoum',
						'description' => ''
					],
					[
						'time' => '10:30- 11:00',
						'activity' =>'Keynote 1:',
						'speakers' => '<span class="heading11">Ms. Charlotte McClain-Nhlapo</span>, Global Disability Advisor- World Bank Group',
						'description' => 'Inclusive Planning & Policy Development: Translating the UNCRPD into National & Local Strategies'
					],
					[
						'time' => '11:00- 11:30',
						'activity' =>'Keynote 2:',
						'speakers' => '<span class="heading11">Mr. Victor Calise</span>, Commissioner- New York City Mayor’s Office for People with Disabilities.',
						'description' => 'Achieving Inclusion in a Global Mega-City: The  Case of New York City'
					],
					[
						'time' => '11:30- 12:00',
						'activity' =>'Keynote 3:',
						'speakers' => 'Dr. Ivor Ambrose, Managing Director ENAT - European Network for Accessible Tourism',
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
						'activity' =>'Keynote 3:',
						'speakers' => '<span class="heading11">Mrs. Aisha A. Miran</span>, Assistant Secretary General- Strategy Management Sector- The General Secretariat of the Executive Council of Dubai',
						'description' => 'My Community: Dubai’s Journey Towards Full Inclusion by the Year 2020'
					],
					[
						'time' => '09:15-9:45',
						'activity' =>'Keynote 4:',
						'speakers' => '<span class="heading11">Dr. Peyvand Khaleghian</span>, Managing Partner- Avicenna Partners',
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
						'speakers' => '<br/><br/><br/><span class="heading11">Facilitator: Dr. Michael Gamal-McCormack</span> <br/>Led By: DHA & Task Force<br/><br/> <span class="heading11">Facilitator: Prof. Bill Sarnecky</span>  <br/>Led by: RTA & Task Force<br/><br/> <span class="heading11">Facilitator: Dr. Maha Damaj</span> <br/>Led by: Dr. Alya Al Qassimi & Task Force',
						'description' => 'UNCRPD Translated into Specific Policies and Programs.<br/><br/><span class="heading11">1-	Developmental Screening and Early Intervention  <br/><br/> 2- Inclusive Urban Development <br/><br/>3- Social Protection</span>'
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
						'speakers' => '<br/><br/><br/><span class="heading11">Facilitator:  Dr. Paula Hunt</span><br/> Led by: KHDA & Task Force<br/><br/> <span class="heading11">Facilitators:  Dr. William Kiernan</span><br/>Led by: CDA & Task Force <br/><br/><span class="heading11">Facilitators: Dr. Ivor Ambrose</span><br/>Led by Dubai Tourism',
						'description' => 'UNCRPD Translated into Specific Policies and Programs.<br/><br/><span class="heading11"> 4-	Inclusive Education<br/><br/> 5-	Inclusive Employment & Entrepreneurship<br/><br/> 6-	Inclusive Tourism, Leisure and Hospitality </span> '
					],
					[
						'time' => '15:00- 16:00',
						'activity' =>'The Dubai Declaration',
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
						'speakers' => 'تحت رعاية سمو الشيخ منصور بن محمد بن راشد آل مكتوم',
						'description' => ''
					],
					[
						'time' => '10:30 - 11:00 صباحاً',
						'activity' =>'الكلمة الرئيسيّة الأولى:',
						'speakers' => 'السيدة شارلوت ماكلين-نلابو، مستشارة لشؤون الإعاقة العالمية - مجموعة البنك الدولي',
						'description' => 'التخطيط الدامج وتطوير السياسات:
 تحويل اتفاقية حقوق الأشخاص ذوي الإعاقة إلى استراتيجيات وطنيّة ومحلية
'
					],
					[
						'time' => '11:00 - 11:30 صباحاً',
						'activity' =>'الكلمة الرئيسيّة الثانية:',
						'speakers' => 'السيد فيكتور كاليس، مفوض - مكتب عمدة مدينة نيويورك لشؤون الأشخاص ذوي الإعاقة ',
						'description' => 'تحقيق التنمية الدامجة في مدينة عالمية عملاقة:
مدينة نيويورك نموذجاً
'
					],
					[
						'time' => '11:30 - 12:00 ظهراً',
						'activity' =>'الكلمة الرئيسيّة الثالثة:',
						'speakers' => 'الدكتور ايفور أمبروز، عضو منتدب - الشبكة الأوروبية لإتاحة السياحة (ENAT)',
						'description' => 'السياحة المتاحة للجميع: حافز للتنمية الدامجة للوجهات السياحيّة'
					],
					[
						'time' => '12:00 - 1:00 ظهراً',
						'activity' =>'غداء',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '1:00 - 2:30 ظهراً',
						'activity' =>'جلسة المناقشة الأولى:',
						'speakers' => '',
						'description' => '	الكشف والعلاج المبكران<br><span class="heading11"> جلسة المناقشة الثانية:</span> التنمية العمرانية الدامجة<br><span class="heading11"> جلسة المناقشة الثالثة: </span>التوظيف الدامج وتأسيس الأعمال'
					],
					[
						'time' => '2:30 -  2:45 ظهراً',
						'activity' =>'استراحة',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '2:45 - 4:15 عصراً',
						'activity' =>'جلسة المناقشة الرابعة:',
						'speakers' => '',
						'description' => 'التعليم الدامج <br/> <span class="heading11">جلسة المناقشة الخامسة:</span> خدمات الضيافة والسياحة والسفر<br/> <span class="heading11">جلسة المناقشة السادسة:</span> الحماية الاجتماعية'
					],
				],
			'day2' =>
				[

					[
						'time' => '9:00 - 9:15 صباحاً',
						'activity' =>'الكلمة الرئيسية الثالثة:',
						'speakers' => 'السيدة عائشة ميران، مساعد الأمين العام - قطاع الإدارة الاستراتيجية - الأمانة العامة للمجلس التنفيذي لإمارة دبي',
						'description' => 'مجتمعي: مسيرة دبي نحو مدينة دامجة وصديقة للأشخاص ذوي الإعاقة بحلول العام 2020'
					],
					[
						'time' => '9:15 - 9:45 صباحاً',
						'activity' =>'الكلمة الرئيسية الرابعة:',
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
						'activity' =>'تحليل العقبات والتوصيات:',
						'speakers' => '<br/><br/><br/><span class="heading11">المنسق: الدكتور مايكل جامل-ماكورماك</span> <br/>بقيادة: هيئة الصحة بدبي وفرقة العمل<br/><br/> <span class="heading11">المنسق: البروفيسور بيل سارنكي</span>  <br/>بقيادة: هيئة الطرق والمواصلات وفرقة العمل<br/><br/> <span class="heading11">المنسق: الدكتورة مها دماج</span> <br/>بقيادة: الدكتورة علياء القاسمي وفرقة العمل',
						'description' => 'تحويل اتفاقية حقوق الأشخاص ذوي الإعاقة إلى سياسات وبرامج محددة<br/><br/><span class="heading11">1- الكشف والعلاج المبكران<br/><br/> 2- التنمية العمرانية الدامجة <br/><br/>3- الحماية الاجتماعية</span>'
					],
					[
						'time' => '12:00 - 1:00 ظهراً',
						'activity' =>'الغداء',
						'speakers' => '',
						'description' => ''
					],
					[
						'time' => '1:00 - 3:00 ظهراً',
						'activity' =>'تحليل العقبات والتوصيات:',
						'speakers' => '<br/><br/><br/><span class="heading11">المنسق: الدكتورة بولا هانت</span><br/> بقيادة: هيئة المعرفة والتنمية البشرية وفرقة العمل<br/><br/> <span class="heading11">المنسق: الدكتور وليام كيرنان</span><br/>بقيادة: هيئة تنمية المجتمع وفرقة العمل<br/><br/><span class="heading11">المنسق: الدكتور ايفور أمبروز</span><br/>بقيادة: دائرة السياحة في دبي',
						'description' => 'تحويل اتفاقية حقوق الأشخاص ذوي الإعاقة إلى سياسات وبرامج محددة<br/><br/><span class="heading11">4- التعليم الدامج<br/><br/>5- التوظيف الدامج وتأسيس الأعمال<br/><br/>6- خدمات الضيافة والسياحة والسفر</span> '
					],
					[
						'time' => '3:00 - 4:00 عصراً',
						'activity' =>'"إعلان دبي"',
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
