function holidayVM()
{
var self = this;
    self.holidayId =ko.observable("");
    self.holidayTitle = ko.observable("");
    self.holidayReason=  ko.observable("");
    self.holidayDate = ko.observable("");
    self.holidayStartTime =ko.observable("");
    self.holidayEndTime =ko.observable("");

    var holiday ={
        Id :self.holidayId,
        Title:self.holidayTitle,
        Reason:self.holidayReason,
        Date:self.holidayDate,
        StartTime:self.holidayStartTime,
        EndTime:self.holidayEndTime
    };

    self.holiday =  ko.observable();
    self.holidays = ko.observableArray();
    self.edit =function (holiday) {
        self.holiday(holiday);
    };
    self.add =function()
    {

    };
}