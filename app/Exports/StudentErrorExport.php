<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
class StudentErrorExport implements FromCollection, WithHeadings, ShouldAutoSize
{
	use Exportable;
	public $errors;

	public function __construct($errors){
		$this->errors = $errors;
	}
    
    public function collection()
    {
        $errors = $this->errors;
	    return collect($errors);
    }
    public function headings(): array
	{
        return [
            'qualification_name',
			'course_name',
			'year_of_admission',
			'admission_batch',
			'semester',
			'admission_date',
			'enrollment_no',
			'roll_no',
			'student_status',
			'passout_date',
			'first_name',
			'middle_name',
			'last_name',
			'mobile_no',
			'date_of_birth',
			'email',
			'gender',
			'cast_category',
			'religion',
			'blood_group',
			'specific_ailment',
			'nationality',
			'taluka',
			'mother_tongue',
			'student_ssmid',
			'family_ssmid',
			'aadhar_no',
			'bank_name',
			'bank_branch',
			'account_name',
			'account_no',
			'ifsc_code'
        ];
	}
}
