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

<div class="row mt-0">
  <div class="col text-center mb-4">
    <h1 class="">1ST YEAR - 5TH YEAR</h1>
    <h1 class="">SCHEDULE OF CLASS</h1>
    <h1 class="text-uppercase">{{ $course->semester }}, SY {{ $course->sy_start }} - {{ $course->sy_end }}</h1>
  </div>
</div>

@foreach($course->sections as $sec)
<div class="row mb-4">
<table>
  <thead>
    <tr>
      <th scope="col" colspan="3">SECTION: {{ $sec->year }} {{ $sec->section }}</th>
      <th scope="col" colspan="4">ADVISER: {{ $sec->adviser }}</th>
      <th scope="col" colspan="3">ROOM ASSIGNMENT</th>
    </tr>
    <tr>

      <th scope="col">DAYS</th>
      <th scope="col">TIME</th>
      <th scope="col">COURSE CODE</th>
      <th scope="col">DESCRIPTIVE TITLE</th>
      <th scope="col">LECTURE</th>
      <th scope="col">LAB/FIELD</th>
      <th scope="col">UNIT</th>
      <th scope="col">ROOM</th>
      <th scope="col">YR & SEC</th>
      <th scope="col">INSTRUCTOR</th>
    </tr>
  </thead>
  <tbody>
    @foreach($sec->allocate_classroom as $all_cm)
    <tr>
      <td>
        {{ implode(',',$all_cm->days) }}
      </td>
      <td>{{ $all_cm->start_time }} - {{ $all_cm->end_time }}</td>
      {{ $subject = App\Subject::find($all_cm->subject_id) }}
      <td>{{ $subject->code }}</td>
      <td>{{ $subject->description }}</td>
      <td class="td-center">{{ $subject->lec }}</td>
      <td class="td-center">{{ $subject->lab }}</td>
      <td class="td-center">{{ $subject->unit }}</td>

      <td class="td-center">{{ $all_cm->room_no }}</td>
      {{ $section = App\Section::find($all_cm->section_id) }}
      <td class="td-center">{{ $section->year }}{{ $section->section }}</td>
      {{ $teacher = App\Teacher::find($all_cm->teacher_id) }}
      <td class="td-center">{{ $teacher->name }}</td>
    </tr>
    @endforeach
  </tbody>
</table>


</div>

@endforeach

<script type="text/php">
    PDF::setOptions(['dpi' => 150, 'defaultFont' => 'sans-serif']);
</script> 