<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}" media="all" />
<link rel="stylesheet" href="{{ asset('css/print.css') }}" media="all" />

<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">UNIVERSITY OF RIZAL SYSTEM</h1>
    <h1 class="text-sm">MORONG, CAMPUS</h1>
  </div>
</div>
<div class="row">
  <div class="col text-center mb-2">
    <h1 class="">COLLEGE OF ENGINEERING</h1>

  </div>
</div>
<div class="row mb-4 container-fluid">
<table>
  <tbody>
    <tr>
      <td colspan="4" co>Name: {{ $instructor->name }}</td>
      <td colspan="3">Position Title: {{ $instructor->position_title }}</td>
      <td colspan="3">Nature of Appointment: {{ $instructor->nature_of_appoint }}</td>
    </tr>
    <tr>
      <td colspan="10">Degree(s)/Unit Earned: {{ $instructor->degree}}</td>
    </tr>
    <tr>  
      <td colspan="10">Educational Status: {{ $instructor->educ_status}}</td>
    </tr>
    <tr>
      <th>TIME</th>
      <th>DAYS</th>
      <th>SUBJECT CODE</th>
      <th>DESCRIPTION</th>
      <th>LEC</th>
      <th>LAB/SHOP/FIELD</th>
      <th>NO. OF HOURS</th>
      <th>ROOM</th>
      <th>YR & SEC</th>
      <th>CLASS SIZE</th>
    </tr>
    {{ $alloc_classroom = App\AllocateClassroom::where('teacher_id', $instructor->id )->get() }}
    
      @foreach($alloc_classroom as $all_cr)
    <tr>
  
      <td>{{ $all_cr->start_time }} - {{ $all_cr->end_time }}</td>
      <td>{{ implode('-', $all_cr->days)}}</td>
      {{ $subject = App\Subject::find($all_cr->subject_id) }}
      <td>{{ $subject->code }}</td>
      <td>{{ $subject->description }}</td>
      <td>{{ $subject->lec }}</td>
      <td>{{ $subject->lab }}</td>
      <td>{{ $subject->lec + $subject->lab }}</td>
      <td>{{ $all_cr->room_no }}</td>
      {{ $section = App\Section::find($all_cr->section_id) }}
      <td>{{ $section->year }}-{{ $section->section }}</td>
      <td></td>
    </tr>
    @endforeach
  
    <tr>
      <td></td>
      <td></td>
      <td></td>
      {{$lec = DB::table('allocate_classrooms')->where('teacher_id', '=', $all_cr->section_id)->sum('lec') }}
      {{$lab = DB::table('allocate_classrooms')->where('teacher_id', '=', $all_cr->section_id)->sum('lab') }}
      {{$unit = DB::table('allocate_classrooms')->where('teacher_id', '=', $all_cr->section_id)->sum('unit') }}
      <td>Total</td>
      <td>{{ $lec }}</td>
      <td>{{ $lab }}</td>
      <td></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>
  </tbody>
</table>
</div>





<script type="text/php">
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
</script> 