' Licensed to the .NET Foundation under one or more agreements.
' The .NET Foundation licenses this file to you under the MIT license.
' See the LICENSE file in the project root for more information.

Imports Microsoft.CodeAnalysis.Scripting.Hosting
Imports Microsoft.CodeAnalysis.Scripting.Hosting.UnitTests
Imports Xunit

Namespace Microsoft.CodeAnalysis.VisualBasic.Scripting.Hosting.UnitTests

    Public Class ObjectFormatterTests
        Inherits ObjectFormatterTestBase

        Private Shared ReadOnly s_formatter As ObjectFormatter = New TestVisualBasicObjectFormatter()

        <Fact>
        Public Sub DebuggerProxy_FrameworkTypes_ArrayList()
            Dim obj = New ArrayList From {1, 2, True, "goo"}
            Dim str = s_formatter.FormatObject(obj, SingleLineOptions)
            Assert.Equal("ArrayList(4) { 1, 2, True, ""goo"" }", str)
        End Sub

        <Fact>
        Public Sub DebuggerProxy_FrameworkTypes_Hashtable()
            Dim obj = New Hashtable From {{New Byte() {1, 2}, {1, 2, 3}}}
            Dim str = s_formatter.FormatObject(obj, SeparateLinesOptions)
            AssertMembers(str, "Hashtable(1)", "{ Byte(2) { 1, 2 }, Integer(3) { 1, 2, 3 } }")
        End Sub

        <Fact>
        Public Sub DebuggerProxy_FrameworkTypes_Queue()
            Dim obj = New Queue()
            obj.Enqueue(1)
            obj.Enqueue(2)
            obj.Enqueue(3)

            Dim str = s_formatter.FormatObject(obj, SingleLineOptions)
            Assert.Equal("Queue(3) { 1, 2, 3 }", str)
        End Sub

        <Fact>
        Public Sub DebuggerProxy_FrameworkTypes_Stack()
            Dim obj = New Stack()
            obj.Push(1)
            obj.Push(2)
            obj.Push(3)

            Dim str = s_formatter.FormatObject(obj, SingleLineOptions)
            Assert.Equal("Stack(3) { 3, 2, 1 }", str)
        End Sub

        <Fact>
        Public Sub DebuggerProxy_FrameworkTypes_SortedList()
            Dim obj As SortedList = New SortedList()
            obj.Add(3, 4)
            obj.Add(1, 5)
            obj.Add(2, 6)

            Dim str = s_formatter.FormatObject(obj, SingleLineOptions)
            Assert.Equal("SortedList(3) { { 1, 5 }, { 2, 6 }, { 3, 4 } }", str)

            obj = New SortedList()
            obj.Add({3}, New Integer() {4})
            str = s_formatter.FormatObject(obj, SingleLineOptions)
            Assert.Equal("SortedList(1) { { Integer(1) { 3 }, Integer(1) { 4 } } }", str)
        End Sub
    End Class

End Namespace
