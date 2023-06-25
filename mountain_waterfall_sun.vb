Public Class StartupFunding
    Private m_amount As Double
    Private m_recipient As String
    Private m_startupName As String
    Private m_businessType As String

    Public Sub New()
        m_amount = 0.0
        m_recipient = ""
        m_startupName = ""
        m_businessType = ""
    End Sub

    Public Sub SetAmount(ByVal amount As Double)
        m_amount = amount
    End Sub

    Public Sub SetRecipient(ByVal recipient As String)
        m_recipient = recipient
    End Sub

    Public Sub SetStartupName(ByVal startupName As String)
        m_startupName = startupName
    End Sub

    Public Sub SetBusinessType(ByVal businessType As String)
        m_businessType = businessType
    End Sub

    Public Function GetAmount() As Double
        Return m_amount
    End Function

    Public Function GetRecipient() As String
        Return m_recipient
    End Function

    Public Function GetStartupName() As String
        Return m_startupName
    End Function

    Public Function GetBusinessType() As String
        Return m_businessType
    End Function

    Public Sub CompileFundingRequest()
        Dim fundingRequest As New StringBuilder()
        fundingRequest.AppendFormat("Startup Name: {0}", m_startupName)
        fundingRequest.AppendLine()
        fundingRequest.AppendFormat("Business Type: {0}", m_businessType)
        fundingRequest.AppendLine()
        fundingRequest.AppendFormat("Amount Requested: {0}", m_amount)
        fundingRequest.AppendLine()
        fundingRequest.AppendFormat("Recipient: {0}", m_recipient)
        MsgBox(fundingRequest.ToString())
    End Sub

    Public Function ApproveFundingRequest() As Boolean
        Dim approved As Boolean = False
        If m_amount > 0.0 _
            And m_recipient.Length > 0 _
            And m_startupName.Length > 0 _
            And m_businessType.Length > 0 Then
            approved = True
        End If
        Return approved
    End Function

End Class