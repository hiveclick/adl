<?php
namespace Adl;

use Mojavi\Form\MojaviForm;

/**
 * Stores lead data
 * @author hobby
 */
class Lead extends MojaviForm {

	protected $FirstName;
	protected $LastName;
	protected $Gender;
	protected $MaritalStatusDesc;
	protected $PrimaryLanguageDesc = "English";
	protected $DateOfBirth;
	protected $SpouseName;
	protected $SSN;
	protected $Address1;
	protected $Address2;
	protected $City;
	protected $StateDesc;
	protected $ZipCode;
	protected $Country;
	protected $MobileNumber;
	protected $OfficeNumber;
	protected $OtherNumber;
	protected $Fax;
	protected $EmailId;
	protected $Reason;
	protected $GenderPreferenceDesc = "No Preference";
	protected $Diet;
	protected $CaregiverNote;
	protected $ADLRequired;
	protected $Allergies;
	protected $Height;
	protected $Weight;
	protected $OfficeNote;
	protected $IsFollowUp;
	protected $FollowUpDays;
	protected $FollowUp;
	protected $EmergencyNote;
	protected $ProgramTypeIdDesc = "HomeCare";
	protected $LeadNotes;
	protected $CompanyReferralCompany;

	/**
	 * Returns the FirstName
	 * @return string
	 */
	function getFirstname() {
		if (is_null($this->FirstName)) {
			$this->FirstName = "";
		}
		return $this->FirstName;
	}

	/**
	 * Sets the FirstName
	 * @var string
	 * @return Lead
	 */
	function setFirstname($arg0) {
		$this->FirstName = $arg0;
		$this->addModifiedColumn('FirstName');
		return $this;
	}

	/**
	 * Returns the LastName
	 * @return string
	 */
	function getLastname() {
		if (is_null($this->LastName)) {
			$this->LastName = "";
		}
		return $this->LastName;
	}

	/**
	 * Sets the LastName
	 * @var string
	 * @return Lead
	 */
	function setLastname($arg0) {
		$this->LastName = $arg0;
		$this->addModifiedColumn('LastName');
		return $this;
	}

	/**
	 * Returns the Gender
	 * M - Male
	 * F - Female
	 * @return string
	 */
	function getGender() {
		if (is_null($this->Gender)) {
			$this->Gender = "M";
		}
		return $this->Gender;
	}

	/**
	 * Sets the Gender
	 * @var string
	 * @return Lead
	 */
	function setGender($arg0) {
		$this->Gender = $arg0;
		$this->addModifiedColumn('Gender');
		return $this;
	}

	/**
	 * Returns the MaritalStatusDesc
	 * Single
	 * Married
	 * Widowed
	 * Divorced
	 * Partner
	 * Separated
	 * @return string
	 */
	function getMaritalStatus() {
		if (is_null($this->MaritalStatusDesc)) {
			$this->MaritalStatusDesc = "Married";
		}
		return $this->MaritalStatusDesc;
	}

	/**
	 * Sets the MaritalStatusDesc
	 * @var string
	 * @return Lead
	 */
	function setMaritalStatus($arg0) {
		$this->MaritalStatusDesc = $arg0;
		$this->addModifiedColumn('MaritalStatusDesc');
		return $this;
	}

	/**
	 * Returns the PrimaryLanguageDesc
	 * @return string
	 */
	function getPrimaryLanguage() {
		if (is_null($this->PrimaryLanguageDesc)) {
			$this->PrimaryLanguageDesc = "English";
		}
		return $this->PrimaryLanguageDesc;
	}

	/**
	 * Sets the PrimaryLanguageDesc
	 * @var string
	 * @return Lead
	 */
	function setPrimaryLanguage($arg0) {
		$this->PrimaryLanguageDesc = $arg0;
		$this->addModifiedColumn('PrimaryLanguageDesc');
		return $this;
	}

	/**
	 * Returns the DateOfBirth
	 * @return string
	 */
	function getDateOfBirth() {
		if (is_null($this->DateOfBirth)) {
			$this->DateOfBirth = date('m-d-Y');
		}
		return $this->DateOfBirth;
	}

	/**
	 * Sets the DateOfBirth
	 * @var string
	 * @return Lead
	 */
	function setDateOfBirth($arg0) {
		if (is_string($arg0)) {
			$this->DateOfBirth = date('m-d-Y', strtotime($arg0));
		}
		$this->addModifiedColumn('DateOfBirth');
		return $this;
	}

	/**
	 * Returns the SpouseName
	 * @return string
	 */
	function getSpouseName() {
		if (is_null($this->SpouseName)) {
			$this->SpouseName = "";
		}
		return $this->SpouseName;
	}

	/**
	 * Sets the SpouseName
	 * @var string
	 * @return Lead
	 */
	function setSpouseName($arg0) {
		$this->SpouseName = $arg0;
		$this->addModifiedColumn('SpouseName');
		return $this;
	}

	/**
	 * Returns the SSN
	 * @return string
	 */
	function getSsn() {
		if (is_null($this->SSN)) {
			$this->SSN = "";
		}
		return $this->SSN;
	}

	/**
	 * Sets the SSN
	 * @var string
	 * @return Lead
	 */
	function setSsn($arg0) {
		$this->SSN = $arg0;
		$this->addModifiedColumn('SSN');
		return $this;
	}

	/**
	 * Returns the Address1
	 * @return string
	 */
	function getAddress1() {
		if (is_null($this->Address1)) {
			$this->Address1 = "";
		}
		return $this->Address1;
	}

	/**
	 * Sets the Address1
	 * @var string
	 * @return Lead
	 */
	function setAddress1($arg0) {
		$this->Address1 = $arg0;
		$this->addModifiedColumn('Address1');
		return $this;
	}

	/**
	 * Returns the Address2
	 * @return string
	 */
	function getAddress2() {
		if (is_null($this->Address2)) {
			$this->Address2 = "";
		}
		return $this->Address2;
	}

	/**
	 * Sets the Address2
	 * @var string
	 * @return Lead
	 */
	function setAddress2($arg0) {
		$this->Address2 = $arg0;
		$this->addModifiedColumn('Address2');
		return $this;
	}

	/**
	 * Returns the City
	 * @return string
	 */
	function getCity() {
		if (is_null($this->City)) {
			$this->City = "";
		}
		return $this->City;
	}

	/**
	 * Sets the City
	 * @var string
	 * @return Lead
	 */
	function setCity($arg0) {
		$this->City = $arg0;
		$this->addModifiedColumn('City');
		return $this;
	}

	/**
	 * Returns the StateDesc
	 * @return string
	 */
	function getState() {
		if (is_null($this->StateDesc)) {
			$this->StateDesc = "";
		}
		return $this->StateDesc;
	}

	/**
	 * Sets the StateDesc
	 * @var string
	 * @return Lead
	 */
	function setState($arg0) {
		$this->StateDesc = $arg0;
		$this->addModifiedColumn('StateDesc');
		return $this;
	}

	/**
	 * Returns the ZipCode
	 * @return string
	 */
	function getZipCode() {
		if (is_null($this->ZipCode)) {
			$this->ZipCode = "";
		}
		return $this->ZipCode;
	}

	/**
	 * Sets the ZipCode
	 * @var string
	 * @return Lead
	 */
	function setZipCode($arg0) {
		$this->ZipCode = $arg0;
		$this->addModifiedColumn('ZipCode');
		return $this;
	}

	/**
	 * Returns the Country
	 * @return string
	 */
	function getCountry() {
		if (is_null($this->Country)) {
			$this->Country = "US";
		}
		return $this->Country;
	}

	/**
	 * Sets the Country
	 * @var string
	 * @return Lead
	 */
	function setCountry($arg0) {
		$this->Country = $arg0;
		$this->addModifiedColumn('Country');
		return $this;
	}

	/**
	 * Returns the MobileNumber
	 * @return string
	 */
	function getMobileNumber() {
		if (is_null($this->MobileNumber)) {
			$this->MobileNumber = "";
		}
		return $this->MobileNumber;
	}

	/**
	 * Sets the MobileNumber
	 * @var string
	 * @return Lead
	 */
	function setMobileNumber($arg0) {
		$this->MobileNumber = $arg0;
		$this->addModifiedColumn('MobileNumber');
		return $this;
	}

	/**
	 * Returns the OfficeNumber
	 * @return string
	 */
	function getOfficeNumber() {
		if (is_null($this->OfficeNumber)) {
			$this->OfficeNumber = "";
		}
		return $this->OfficeNumber;
	}

	/**
	 * Sets the OfficeNumber
	 * @var string
	 * @return Lead
	 */
	function setOfficeNumber($arg0) {
		$this->OfficeNumber = $arg0;
		$this->addModifiedColumn('OfficeNumber');
		return $this;
	}

	/**
	 * Returns the OtherNumber
	 * @return string
	 */
	function getOtherNumber() {
		if (is_null($this->OtherNumber)) {
			$this->OtherNumber = "";
		}
		return $this->OtherNumber;
	}

	/**
	 * Sets the OtherNumber
	 * @var string
	 * @return Lead
	 */
	function setOtherNumber($arg0) {
		$this->OtherNumber = $arg0;
		$this->addModifiedColumn('OtherNumber');
		return $this;
	}

	/**
	 * Returns the Fax
	 * @return string
	 */
	function getFax() {
		if (is_null($this->Fax)) {
			$this->Fax = "";
		}
		return $this->Fax;
	}

	/**
	 * Sets the Fax
	 * @var string
	 * @return Lead
	 */
	function setFax($arg0) {
		$this->Fax = $arg0;
		$this->addModifiedColumn('Fax');
		return $this;
	}

	/**
	 * Returns the EmailId
	 * @return string
	 */
	function getEmailId() {
		if (is_null($this->EmailId)) {
			$this->EmailId = "";
		}
		return $this->EmailId;
	}

	/**
	 * Sets the EmailId
	 * @var string
	 * @return Lead
	 */
	function setEmailId($arg0) {
		$this->EmailId = $arg0;
		$this->addModifiedColumn('EmailId');
		return $this;
	}

	/**
	 * Returns the Reason
	 * @return string
	 */
	function getReason() {
		if (is_null($this->Reason)) {
			$this->Reason = "";
		}
		return $this->Reason;
	}

	/**
	 * Sets the Reason
	 * @var string
	 * @return Lead
	 */
	function setReason($arg0) {
		$this->Reason = $arg0;
		$this->addModifiedColumn('Reason');
		return $this;
	}

	/**
	 * Returns the GenderPreferenceDesc
	 * No Preference
	 * Male
	 * Female
	 * @return string
	 */
	function getGenderPreference() {
		if (is_null($this->GenderPreferenceDesc)) {
			$this->GenderPreferenceDesc = "No Preference";
		}
		return $this->GenderPreferenceDesc;
	}

	/**
	 * Sets the GenderPreferenceDesc
	 * @var string
	 * @return Lead
	 */
	function setGenderPreference($arg0) {
		$this->GenderPreferenceDesc = $arg0;
		$this->addModifiedColumn('GenderPreferenceDesc');
		return $this;
	}

	/**
	 * Returns the Diet
	 * @return string
	 */
	function getDiet() {
		if (is_null($this->Diet)) {
			$this->Diet = "";
		}
		return $this->Diet;
	}

	/**
	 * Sets the Diet
	 * @var string
	 * @return Lead
	 */
	function setDiet($arg0) {
		$this->Diet = $arg0;
		$this->addModifiedColumn('Diet');
		return $this;
	}

	/**
	 * Returns the CaregiverNote
	 * @return string
	 */
	function getCaregiverNote() {
		if (is_null($this->CaregiverNote)) {
			$this->CaregiverNote = "";
		}
		return $this->CaregiverNote;
	}

	/**
	 * Sets the CaregiverNote
	 * @var string
	 * @return Lead
	 */
	function setCaregiverNote($arg0) {
		$this->CaregiverNote = $arg0;
		$this->addModifiedColumn('CaregiverNote');
		return $this;
	}

	/**
	 * Returns the ADLRequired
	 * @return string
	 */
	function getAdlRequired() {
		if (is_null($this->ADLRequired)) {
			$this->ADLRequired = "N";
		}
		return $this->ADLRequired;
	}

	/**
	 * Sets the ADLRequired
	 * @var string
	 * @return Lead
	 */
	function setAdlRequired($arg0) {
		$this->ADLRequired = $arg0;
		$this->addModifiedColumn('ADLRequired');
		return $this;
	}

	/**
	 * Returns the Allergies
	 * @return string
	 */
	function getAllergies() {
		if (is_null($this->Allergies)) {
			$this->Allergies = "";
		}
		return $this->Allergies;
	}

	/**
	 * Sets the Allergies
	 * @var string
	 * @return Lead
	 */
	function setAllergies($arg0) {
		$this->Allergies = $arg0;
		$this->addModifiedColumn('Allergies');
		return $this;
	}

	/**
	 * Returns the Height
	 * @return string
	 */
	function getHeight() {
		if (is_null($this->Height)) {
			$this->Height = "";
		}
		return $this->Height;
	}

	/**
	 * Sets the Height
	 * @var string
	 * @return Lead
	 */
	function setHeight($arg0) {
		$this->Height = $arg0;
		$this->addModifiedColumn('Height');
		return $this;
	}

	/**
	 * Returns the Weight
	 * @return string
	 */
	function getWeight() {
		if (is_null($this->Weight)) {
			$this->Weight = "";
		}
		return $this->Weight;
	}

	/**
	 * Sets the Weight
	 * @var string
	 * @return Lead
	 */
	function setWeight($arg0) {
		$this->Weight = $arg0;
		$this->addModifiedColumn('Weight');
		return $this;
	}

	/**
	 * Returns the OfficeNote
	 * @return string
	 */
	function getOfficeNote() {
		if (is_null($this->OfficeNote)) {
			$this->OfficeNote = "";
		}
		return $this->OfficeNote;
	}

	/**
	 * Sets the OfficeNote
	 * @var string
	 * @return Lead
	 */
	function setOfficeNote($arg0) {
		$this->OfficeNote = $arg0;
		$this->addModifiedColumn('OfficeNote');
		return $this;
	}

	/**
	 * Returns the IsFollowUp
	 * @return string
	 */
	function getIsFollowUp() {
		if (is_null($this->IsFollowUp)) {
			$this->IsFollowUp = "N";
		}
		return $this->IsFollowUp;
	}

	/**
	 * Sets the IsFollowUp
	 * @var string
	 * @return Lead
	 */
	function setIsFollowUp($arg0) {
		$this->IsFollowUp = $arg0;
		$this->addModifiedColumn('IsFollowUp');
		return $this;
	}

	/**
	 * Returns the FollowUpDays
	 * @return integer
	 */
	function getFollowUpDays() {
		if (is_null($this->FollowUpDays)) {
			$this->FollowUpDays = 0;
		}
		return $this->FollowUpDays;
	}

	/**
	 * Sets the FollowUpDays
	 * @var integer
	 * @return Lead
	 */
	function setFollowUpDays($arg0) {
		$this->FollowUpDays = (int)$arg0;
		$this->addModifiedColumn('FollowUpDays');
		return $this;
	}

	/**
	 * Returns the FollowUp
	 * @return string
	 */
	function getFollowUp() {
		if (is_null($this->FollowUp)) {
			$this->FollowUp = "";
		}
		return $this->FollowUp;
	}

	/**
	 * Sets the FollowUp
	 * @var string
	 * @return Lead
	 */
	function setFollowUp($arg0) {
		$this->FollowUp = $arg0;
		$this->addModifiedColumn('FollowUp');
		return $this;
	}

	/**
	 * Returns the EmergencyNote
	 * @return string
	 */
	function getEmergencyNote() {
		if (is_null($this->EmergencyNote)) {
			$this->EmergencyNote = "";
		}
		return $this->EmergencyNote;
	}

	/**
	 * Sets the EmergencyNote
	 * @var string
	 * @return Lead
	 */
	function setEmergencyNote($arg0) {
		$this->EmergencyNote = $arg0;
		$this->addModifiedColumn('EmergencyNote');
		return $this;
	}

	/**
	 * Returns the ProgramTypeIdDesc
	 * @return string
	 */
	function getProgramTypeId() {
		if (is_null($this->ProgramTypeIdDesc)) {
			$this->ProgramTypeIdDesc = "HomeCare";
		}
		return $this->ProgramTypeIdDesc;
	}

	/**
	 * Sets the ProgramTypeIdDesc
	 * HomeCare
	 * TakeCare
	 * @var string
	 * @return Lead
	 */
	function setProgramTypeId($arg0) {
		$this->ProgramTypeIdDesc = $arg0;
		$this->addModifiedColumn('ProgramTypeIdDesc');
		return $this;
	}

	/**
	 * Returns the LeadNotes
	 * @return string
	 */
	function getLeadNotes() {
		if (is_null($this->LeadNotes)) {
			$this->LeadNotes = "";
		}
		return $this->LeadNotes;
	}

	/**
	 * Sets the LeadNotes
	 * @var string
	 * @return Lead
	 */
	function setLeadNotes($arg0) {
		$this->LeadNotes = $arg0;
		$this->addModifiedColumn('LeadNotes');
		return $this;
	}

	/**
	 * Returns the CompanyReferralCompany
	 * @return CompanyReferral
	 */
	function getCompanyReferralCompany() {
		if (is_null($this->CompanyReferralCompany)) {
			$this->CompanyReferralCompany = null;
		}
		return $this->CompanyReferralCompany;
	}

	/**
	 * Sets the CompanyReferralCompany
	 * @var CompanyReferral
	 * @return Lead
	 */
	function setCompanyReferralCompany($arg0) {
		if (is_array($arg0)) {
			$this->CompanyReferralCompany = $this->getCompanyReferralCompany();
			if (is_null($this->CompanyReferralCompany)) {
				$this->CompanyReferralCompany = new CompanyReferral();
			}
			$this->CompanyReferralCompany->populate($arg0);
			$this->addModifiedColumn('CompanyReferralCompany');
		}
		return $this;
	}
}