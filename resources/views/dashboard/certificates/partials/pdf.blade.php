<style>
@page {
    margin: 0;
}

.relative {
    position: relative;
}

.w-full {
    width: 100%;
    height: 100%;
}
</style>
<div class="overflow-scroll w-full relative"

@if ($data['background_image_path']) style="background-image: url('{{ asset(str_replace('public', 'storage', $data['background_image_path'])) }}')" @endif>


    @if ($data['show_title'])
    <div class="absolute" style="
    position: absolute;
                left: {{ $data['title_position_x'] }}px; 
                top: {{ $data['title_position_y'] }}px; 
                color: {{ $data['title_font_color'] }};
                font-size: {{ $data['title_font_size'] }}px;">
        {{ $data['title_data'] }}</div>
    @endif

    @if ($data['show_body'])
    <div class="absolute" style="
    position: absolute;
                left: {{ $data['body_position_x'] }}px; 
                top: {{ $data['body_position_y'] }}px; 
                color: {{ $data['body_font_color'] }};
                font-size: {{ $data['body_font_size'] }}px;">
        {{ $data['body_data'] }}</div>
    @endif

    @if ($data['show_students_name'])
    <div class="absolute" style="
    position: absolute;
                left: {{ $data['student_name_position_x'] }}px; 
                top: {{ $data['student_name_position_y'] }}px; 
                color: {{ $data['student_name_font_color'] }};
                font-size: {{ $data['student_name_font_size'] }}px;">
        {{ $user_certificate->user->getFullName() }}</div>
    @endif

    @if ($data['show_date'])
    <div class="absolute" style="
    position: absolute;
                        left: {{ $data['date_position_x'] }}px; 
                        top: {{ $data['date_position_y'] }}px; 
                        color: {{ $data['date_font_color'] }};
                        font-size: {{ $data['date_font_size'] }}px;">
        {{ $user_certificate->created_at->format('dS F Y') }}</div>
    @endif

    @if ($data['show_footer'])
    <div class="absolute" style="
    position: absolute;
                                left: {{ $data['footer_position_x'] }}px; 
                                top: {{ $data['footer_position_y'] }}px; 
                                color: {{ $data['footer_font_color'] }};
                                font-size: {{ $data['footer_font_size'] }}px;">
        {{ $data['footer_data'] }}</div>
    @endif

    @if ($data['show_signature'])
    <div class="absolute" style="
    position: absolute;
                                        left: {{ $data['signature_position_x'] }}px; 
                                        top: {{ $data['signature_position_y'] }}px; ">
        <img style="width: {{ $data['signature_image_width'] }}px; height: {{ $data['signature_image_height'] }}px;" src="{{ asset(str_replace('public', 'storage', $data['signature_image_path'])) }}">

    </div>
    @endif


</div>