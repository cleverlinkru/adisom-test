<?php

namespace Apps\AdisomTest\Http\Requests\Recommendations;

use Illuminate\Foundation\Http\FormRequest;

class IndexRecommendationsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'category' => ['string'],
            'min_subscribers' => ['integer', 'min:0'],
            'max_subscribers' => ['integer', 'min:0'],
            'language' => ['string'],
            'region' => ['string'],
            'last_video_period' => ['string', 'in:last_7_days,last_month,last_year'],
            'order_by' => ['string', 'in:engagement_rate,average_views'],
            'order' => ['string', 'in:asc,desc'],
        ];
    }
    
    public function generateKey(): string
    {
        return $this->input('category'). '-' . 
            $this->input('min_subscribers'). '-' . 
            $this->input('max_subscribers'). '-' .
            $this->input('language'). '-' .
            $this->input('region'). '-' .
            $this->input('last_video_period'). '-' .
            $this->input('order_by'). '-' .
            $this->input('order');
    }
}
