' Licensed to the .NET Foundation under one or more agreements.
' The .NET Foundation licenses this file to you under the MIT license.
' See the LICENSE file in the project root for more information.

'-----------------------------------------------------------------------------------------------------------
'Code the generate a dumper class for a given parse tree. Reads the parse tree and outputs
'a dumper utility class.
'-----------------------------------------------------------------------------------------------------------

Imports System.IO

Friend Class WriteDumper
    Inherits WriteUtils

    Private ReadOnly _checksum As String
    Private _writer As TextWriter    'output is sent here.

    Public Sub New(parseTree As ParseTree, checksum As String)
        MyBase.New(parseTree)
        _checksum = checksum
    End Sub

    ' Write the dumper utility function to the given file.
    Public Sub WriteDumper(filename As String)
        _writer = New StreamWriter(New FileStream(filename, FileMode.Create, FileAccess.Write))

        Using _writer
            GenerateFile()
        End Using
    End Sub

    ' Write the whole contents of the file.
    Private Sub GenerateFile()
        _writer.WriteLine("' Definition of parse trees dumper.")
        _writer.WriteLine("' DO NOT HAND EDIT")
        _writer.WriteLine()

        GenerateNamespace()
    End Sub

    ' Create imports and the namespace declaration around the whole file
    Private Sub GenerateNamespace()
        _writer.WriteLine("Imports System.Collections.Generic")
        _writer.WriteLine("Imports System.IO")
        _writer.WriteLine()
        If Not String.IsNullOrEmpty(_parseTree.NamespaceName) Then
            _writer.WriteLine("Namespace {0}", _parseTree.NamespaceName)
            _writer.WriteLine()
        End If

        GenerateDumperClass()

        If Not String.IsNullOrEmpty(_parseTree.NamespaceName) Then
            _writer.WriteLine("End Namespace")
        End If
    End Sub

    ' Generate the partial part of the utilities class with the DumpTree function in it.
    Private Sub GenerateDumperClass()
        _writer.WriteLine("    Public Partial Class NodeInfo")
        _writer.WriteLine()

        ' Create the nested visitor class that does all the real work.
        GenerateDumpVisitor()

        _writer.WriteLine("    End Class")
    End Sub

    Private Sub GenerateDumpVisitor()
        ' Write out the first boilerplate part of the visitor

        _writer.WriteLine("        Private Class Visitor")
        _writer.WriteLine("            Inherits VisualBasicSyntaxVisitor(Of NodeInfo)")
        _writer.WriteLine()

        GenerateDumpVisitorMethods()

        _writer.WriteLine("        End Class")
    End Sub

    ' Generate the Visitor class definition
    Private Sub GenerateDumpVisitorMethods()
        For Each nodeStructure In _parseTree.NodeStructures.Values
            GenerateDumpVisitorMethod(nodeStructure)
        Next
    End Sub

    ' Generate a method in the Visitor class that dumps the given node type.
    Private Sub GenerateDumpVisitorMethod(nodeStructure As ParseNodeStructure)
        _writer.WriteLine("            Public Overrides Function {0}(ByVal node As {1}) As NodeInfo",
                          VisitorMethodName(nodeStructure),
                          StructureTypeName(nodeStructure))

        ' Node, and name of the node structure
        _writer.WriteLine("                Return New NodeInfo(")
        _writer.WriteLine("                    ""{0}"",", StructureTypeName(nodeStructure))

        ' Fields of the node structure
        Dim fieldList = GetAllFieldsOfStructure(nodeStructure)
        If fieldList.Count > 0 Then
            _writer.WriteLine("                    { ")
            For i = 0 To fieldList.Count - 1
                GenerateFieldInfo(fieldList(i), i = fieldList.Count - 1)
            Next
            _writer.WriteLine("                    },")
        Else
            _writer.WriteLine("                    Nothing,")
        End If

        ' Children (including child lists)
        Dim childList = GetAllChildrenOfStructure(nodeStructure)
        _writer.WriteLine("                    { ")
        For i = 0 To childList.Count - 1
            GenerateChildInfo(childList(i), i = childList.Count - 1)
        Next
        _writer.WriteLine("                    })")

        _writer.WriteLine("            End Function")
        _writer.WriteLine()
    End Sub

    ' Write out the code to create info about a simple field; just a primitive
    Private Sub GenerateFieldInfo(field As ParseNodeField, last As Boolean)
        _writer.Write("                        New NodeInfo.FieldInfo(""{0}"", GetType({1}), node.{0})", FieldPropertyName(field), FieldTypeRef(field))

        If last Then
            _writer.WriteLine()
        Else
            _writer.WriteLine(",")
        End If
    End Sub

    ' Write out the code to create info about a child or child list
    Private Sub GenerateChildInfo(child As ParseNodeChild, last As Boolean)
        If child.IsList Then
            If child.IsSeparated Then
                _writer.Write("                        New NodeInfo.ChildInfo(""{0}"", NodeInfo.ChildKind.SeparatedNodeList, GetType({1}), node.{0}, node.{0}.Separators)", ChildPropertyName(child), BaseTypeReference(child))
            Else
                _writer.Write("                        New NodeInfo.ChildInfo(""{0}"", NodeInfo.ChildKind.NodeList, GetType({1}), node.{0}, Nothing)", ChildPropertyName(child), BaseTypeReference(child))
            End If
        Else
            _writer.Write("                        New NodeInfo.ChildInfo(""{0}"", NodeInfo.ChildKind.SingleNode, GetType({1}), node.{0}, Nothing)", ChildPropertyName(child), BaseTypeReference(child))
        End If

        If last Then
            _writer.WriteLine()
        Else
            _writer.WriteLine(",")
        End If
    End Sub

End Class
