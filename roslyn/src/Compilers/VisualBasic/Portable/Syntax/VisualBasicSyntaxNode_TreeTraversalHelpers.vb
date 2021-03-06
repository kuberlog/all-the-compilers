' Licensed to the .NET Foundation under one or more agreements.
' The .NET Foundation licenses this file to you under the MIT license.
' See the LICENSE file in the project root for more information.

'-----------------------------------------------------------------------------------------------------------
'  Contains syntax tree traversal methods.
'-----------------------------------------------------------------------------------------------------------

Namespace Microsoft.CodeAnalysis.VisualBasic
    Partial Public Class VisualBasicSyntaxNode
        ''' <summary>
        ''' Finds a token according to the following rules:
        ''' 1)	If position matches the End of the node's Span, then its last token is returned. 
        ''' 
        ''' 2)	If node.FullSpan.Contains(position) then the token that contains given position is returned.
        ''' 
        ''' 3)	Otherwise an IndexOutOfRange is thrown
        ''' </summary>
        Public Shadows Function FindToken(position As Integer, Optional findInsideTrivia As Boolean = False) As SyntaxToken
            Return MyBase.FindToken(position, findInsideTrivia)
        End Function

        Public Shadows Function FindTrivia(textPosition As Integer, Optional findInsideTrivia As Boolean = False) As SyntaxTrivia
            Return MyBase.FindTrivia(textPosition, findInsideTrivia)
        End Function
    End Class
End Namespace
