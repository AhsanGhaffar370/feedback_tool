<select name="sub_category_id" class="bss_select form-control @error('sub_category_id') is-invalid @enderror">
  <option value="" selected disabled>Select Sub Category</option>
  @foreach ($sub_categories as $sub_category)
    <option value="{{ $sub_category->id }}" {{ old('sub_category_id') == $sub_category->id ? 'selected' : '' }}>
      {{ $sub_category->name }}</option>
  @endforeach
</select>